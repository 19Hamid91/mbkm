<?php

namespace App\Http\Controllers;

use App\Mail\EmailVer;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    function login()
    {
        return view('auth.auth');
    }
    function forgetForm($token)
    {
        return view('auth.forget', ['token' => $token]);
    }
    function forgetAct(Request $req)
    {
        if ($req->ver == $req->password) {
            $token = Str::random(40);
            $updateUser = User::where('token', $req->token)->update([
                'password' => bcrypt($req->password)
            ]);
            if ($updateUser) {
                $updateUser1 = User::where('token', $req->token)->update([
                    'token' => $token
                ]);
                return redirect('/login')->with('success', 'Password berhasil diupdate');
            } else {
                return redirect()->back()->with('fail', 'Token tidak tersedia');
            }
        } else {
            return redirect()->back()->with('fail', 'password tidak sama');
        }
    }

    function changePassword($pass, $pass_old, $pass_ver)
    {
        // return Auth::user();
        $getUser = User::where('id', Auth::user()->id)->first();
        if (Hash::check($pass_old, $getUser->password)) {
            if ($pass == $pass_ver) {
                $updateUser = User::where('id', Auth::user()->id)->update([
                    'password' => bcrypt($pass)
                ]);
                if ($updateUser) {
                    return response()->json(['success' => 1, 'message' => 'Password berhasil diupdate']);
                }
            } else {
                return response()->json(['success' => 0, 'message' => 'Ulangi password salah']);
            }
        } else {
            return response()->json(['success' => 0, 'message' => 'Password lama anda salah']);
        }
    }

    function loginAct(Request $req)
    {
        // pemlap
        if (strpos($req->email, "@") !== false) {
            $getUser = User::where('email', $req->email)->first();
            if ($getUser) {
                if ($getUser->role == "PEMLAP") {
                    // return $getUser;
                    if (Auth::loginUsingId($getUser->id))
                        return redirect('/pemlap');
                } elseif ($getUser->role == "ADMIN") {
                    if (Auth::loginUsingId($getUser->id))
                        return redirect('/admin');
                }
            }
        }
        $response = Http::withHeaders(['token-daspim' => '123'])
            ->get('https://simpeg.polines.ac.id/Dashboard/getPegawaiByKode/' . $req->email);
        $res = $response->json();
        // dd($response);
        // dosen
        if ($res != null) {
            $checkDosen = Dosen::where('nip', $req->email)->first();
            $checkUser = User::where('email', $req->email)->first();
            // return $checkUser;
            if (!$checkDosen && !$checkUser) {
                // return $response;
                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['prodi'] == null) {
                        return redirect()->back()->with('fail', 'Prodi masih kosong');
                    }
                    if ($data['jurusan'] == null) {
                        return redirect()->back()->with('fail', 'Jurusan masih kosong');
                    }
                    $newUser = new User;
                    $newUser->name = $data['nm_pegawai'];
                    $newUser->email = $data['nip_baru'];
                    $checkAdmin = User::where('role', "ADMIN")->first();
                    // if($checkAdmin){
                    $newUser->role = "DOSEN";
                    // } else {
                    //     $newUser->role = "ADMIN";
                    // }
                    $newUser->password = bcrypt("123");
                    $newUser->save();

                    $newDosen = new Dosen;
                    $newDosen->nama = $data['nm_pegawai'];
                    $newDosen->email = $data['email_pegawai'];
                    $newDosen->nip = $data['nip_baru'];
                    $newDosen->jenis_kelamin = $data['jenis_kelamin'];
                    $newDosen->nidn = $data['nidn'];
                    $newDosen->alamat_jalan = $data['alamat_jalan'];
                    $newDosen->telepon_pegawai = $data['telepon_pegawai'];
                    $newDosen->jabatan = "Dosen";


                    if ($data['prodi']['nm_jenjang'] == "Diploma 3") {
                        $convJenjang = "Diploma III";
                        $convProdi = str_replace(' (D3)', '', $data['prodi']['nm_prodi']);
                    } else {
                        $convJenjang = $data['prodi']['nm_jenjang'];
                        $convProdi = str_replace(' (S.Tr)', '', $data['prodi']['nm_prodi']);
                    }

                    $newDosen->jenjang = $convJenjang;
                    $newDosen->jurusan = $data['jurusan']['nm_jurusan'];
                    $newDosen->prodi = $convProdi;
                    $newDosen->save();

                    $getUser = User::where('email', $data['nip_baru'])->first();
                    $check = Auth::loginUsingId($getUser->id);
                    if ($check) {
                        if ($getUser->role == "KAPRODI") {
                            return redirect('/kaprodi');
                        } elseif ($getUser->role == "KAJUR") {
                            return redirect('/kajur');
                        } elseif ($getUser->role == "PIMPINAN") {
                            return redirect('/pimpinan');
                        } elseif ($getUser->role == "DOSEN") {
                            return redirect('/dosbing');
                        } elseif ($getUser->role == "ADMIN") {
                            return redirect('/admin');
                        } elseif ($getUser->role == "PIC") {
                            return redirect('/pic');
                        }
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Pemanggilan API gagal']);
                }
            } elseif ($checkDosen) {
                $check = Auth::loginUsingId($checkUser->id);
                if ($check) {
                    if ($checkUser->role == "KAPRODI") {
                        return redirect('/kaprodi');
                    } elseif ($checkUser->role == "KAJUR") {
                        return redirect('/kajur');
                    } elseif ($checkUser->role == "PIMPINAN") {
                        return redirect('/pimpinan');
                    } elseif ($checkUser->role == "DOSEN") {
                        return redirect('/dosbing');
                    } elseif ($checkUser->role == "ADMIN") {
                        return redirect('/admin');
                    } elseif ($checkUser->role == "PIC") {
                        return redirect('/pic');
                    }
                }
            }
        } else {
            $checkMhs = Mahasiswa::where('nim', $req->email)->first();
            // return $req->email;
            if (!$checkMhs) {
                $getToken = Http::post('https://simadu.polines.ac.id/api/login', [
                    "email" => "omahiot@gmail.com",
                    "password" => "Polines#2022"
                ])->json();

                $getMahasiswa = Http::asForm()->withHeaders([
                    'Authorization' => 'Bearer ' . $getToken['data']['token']
                ])->post('https://simadu.polines.ac.id/api/mahasiswa/', [
                    'nim' => $req->email
                ])->json();
                
                if (empty($getMahasiswa['data'])) {
                    return redirect()->back()->with('fail', 'Nim tidak ditemukan');
                }
                
                $bulan = [9,10,11,12,1,2]; //smt ganjil
                if(in_array(now()->month, $bulan)){
                    $tahun =  date('Y', strtotime('-1 year'));
                    $smt = '2';
                } else {
                    $tahun = now()->year;
                    $smt = '1';
                }
                
                $lastSmtId = $tahun.$smt;
                
                // kelas
                $getKelas = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $getToken['data']['token']
                ])->get('https://simadu.polines.ac.id/api/presensi/'.$lastSmtId)->json();
                // $getKelas = Http::withHeaders([
                //     'Authorization' => 'Bearer ' . $getToken['data']['token']
                // ])->get('https://simadu.polines.ac.id/api/trnlm/'.$lastSmtId)->json();
                $filteredArray = Arr::where($getKelas['data'], function ($value, $key) use($req) {
                    return $value['NIM'] ==  $req->email;
                });
                $arrKey = array_keys($filteredArray);
                
                if($filteredArray[$arrKey[0]]){
                    $kelas = $filteredArray[$arrKey[0]]['kelas'];
                } else {
                    $kelas = null;
                }
                // kelas end
                
                // ipk
                $getIPK = Http::withHeaders([
                'Authorization' => 'Bearer ' . $getToken['data']['token']
                ])->get('https://simadu.polines.ac.id/api/trakm/'.$lastSmtId)->json();
                $filteredArray2 = Arr::where($getIPK['data'], function ($value, $key) use($req) {
                    return $value['NIM'] ==  $req->email;
                });
                $arrKey2 = array_keys($filteredArray2);
                
                if($filteredArray2[$arrKey2[0]]){
                    $ipk = $filteredArray2[$arrKey2[0]]['Indek_prestasi_Kumulatif'];
                } else {
                    $ipk = null;
                }
                // ipk end
                
                // return $getMahasiswa;
                // return $getToken['data']['token'];
                // if ($req->password == $req->ver) {
                $token = Str::random(36);
                $createUser = User::create([
                    'name' => $getMahasiswa['data'][0]['Nama'],
                    'email' => $getMahasiswa['data'][0]['NIM'],
                    'nim' => $getMahasiswa['data'][0]['NIM'],
                    'password' => bcrypt($req->password),
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'role' => 'MHS'
                ]);
                // dd($createUser);
                if ($createUser) {
                    $getUser = User::where('email', $getMahasiswa['data'][0]['NIM'])->first();
                    $createMhs = Mahasiswa::create([
                        'nama' => $getMahasiswa['data'][0]['Nama'],
                        'nim' => $getMahasiswa['data'][0]['NIM'],
                        'telp' => $getMahasiswa['data'][0]['Telepon'],
                        'user_id' => $getUser->id,
                        'prodi' => $getMahasiswa['data'][0]['Program_studi'],
                        'jenjang' => $getMahasiswa['data'][0]['Jenjang'],
                        'jurusan' => $getMahasiswa['data'][0]['Jurusan'],
                        'alamat' => $getMahasiswa['data'][0]['Alamat'],
                        'jenis_kelamin' => $getMahasiswa['data'][0]['Jenis_kelamin'],
                        'ipk' => $ipk,
                        'kelas' => $kelas
                    ]);
                    if ($createMhs) {
                        $getUser->token = $token;
                        $getUser->save();
                        // dd("v");
                        // Mail::to($getMahasiswa['data'][0]['Email'])->send(new EmailVer($token, "ver"));
                        $checkLogin = Auth::loginUsingId($getUser->id);
                        if ($checkLogin) {
                            return redirect('/mbkm/in');
                        }
                        // return redirect()->back()->with('success', 'Selamat akun anda berhasil bibuat, silahkan check email anda untuk melakukan verifikasi ' . $getMahasiswa['data'][0]['Email']);
                    }
                }
            } else {
                if ($checkMhs->user->email_verified_at == null) {
                    // return $checkMhs->user;
                    return redirect()->back()->with('fail', 'Email Belumm terverifikasi');
                } else {
                    // return $checkMhs->user;
                    $checkLogin = Auth::loginUsingId($checkMhs->user->id);
                    if ($checkLogin) {
                        return redirect('/mbkm/in');
                    }
                }
            }

            // } else {
            //     return redirect()->back()->with('fail', 'Password yang anda masukan tidak cocok');
            // }
        }

        // return $req->all();
        // if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
        //     $token = Str::random(36);
        //     $getUser = User::where('email', $req->email)->first();
        //     if ($getUser->role == "MHS") {
        //         if ($getUser->email_verified_at == null) {
        //             $getUser->token = $token;
        //             $getUser->save();
        //             Mail::to($getUser->email)->send(new EmailVer($token, "ver"));
        //         }
        //         return redirect('/mbkm/in');
        //     } elseif ($getUser->role == "BAKPK") {
        //         return redirect('/bakpk');
        //     } elseif ($getUser->role == "PEMLAP") {
        //         return redirect('/pemlap');
        //     }
        // } else {
        //     return back()->with('fail', 'Email atau password salah, silahkan coba lagi');
        // }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    function regis()
    {
        return view('auth.regis');
    }
    function regisAct(Request $req)
    {
        // return $req->all();
        // return $req->nim;
        // $getUser = Mahasiswa::where('nim', $req->nim)->first();

        // if ($getUser) {
        //     return redirect()->back()->with('fail', 'Nim sudah terdaftar, silahkan login');
        // }
        $getToken = Http::post('https://simadu.polines.ac.id/api/login', [
            "email" => "omahiot@gmail.com",
            "password" => "Polines#2022"
        ])->json();

        $getMahasiswa = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . $getToken['data']['token']
        ])->post('https://simadu.polines.ac.id/api/mahasiswa/', [
            'nim' => $req->nim
        ])->json();
        // return $getMahasiswa;
        if (empty($getMahasiswa['data'])) {
            return redirect()->back()->with('fail', 'Nim tidak ditemukan');
        }
        // return $getToken['data']['token'];
        if ($req->password == $req->ver) {
            $token = Str::random(36);
            $createUser = User::create([
                'name' => $getMahasiswa['data'][0]['Nama'],
                'email' => $getMahasiswa['data'][0]['Email'],
                'password' => bcrypt($req->password),
                'role' => 'MHS'
            ]);
            if ($createUser) {
                $getUser = User::where('email', $getMahasiswa['data'][0]['Email'])->first();
                $createMhs = Mahasiswa::create([
                    'nama' => $getMahasiswa['data'][0]['Nama'],
                    'nim' => $getMahasiswa['data'][0]['NIM'],
                    'telp' => $getMahasiswa['data'][0]['Telepon'],
                    'user_id' => $getUser->id,
                    'prodi' => $getMahasiswa['data'][0]['Program_studi'],
                    'jenjang' => $getMahasiswa['data'][0]['Jenjang'],
                    'jurusan' => $getMahasiswa['data'][0]['Jurusan'],
                    'alamat' => $getMahasiswa['data'][0]['Alamat'],
                    'jenis_kelamin' => $getMahasiswa['data'][0]['Jenis_kelamin']
                ]);
                if ($createMhs) {
                    $getUser->token = $token;
                    $getUser->save();
                    Mail::to($getMahasiswa['data'][0]['Email'])->send(new EmailVer($token, "ver"));
                    return redirect()->back()->with('success', 'Selamat akun anda berhasil bibuat, silahkan check email anda untuk melakukan verifikasi ' . $getMahasiswa['data'][0]['Email']);
                }
            }
        } else {
            return redirect()->back()->with('fail', 'Password yang anda masukan tidak cocok');
        }
    }
    function verEmail($token)
    {
        $getUser = User::where('token', $token)->first();
        if ($getUser) {
            if ($getUser->email_verified_at == null) {
                $getUser->email_verified_at = date('Y-m-d H:i:s');
                if ($getUser->save()) {
                    return redirect('login')->with('success', 'Email terverifikasi');
                }
            } else {
                return "User sudah terverifikasi";
            }
        }
    }
    function resetPassword($email)
    {
        $token = Str::random(40);
        $updateUser = User::where('email', $email)->update([
            'token' => $token
        ]);
        if ($updateUser) {
            Mail::to($email)->send(new EmailVer($token, "reset"));
            return response()->json(['success' => 1, 'message' => 'Email reset password berhasil di kirim']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Email tidak terdaftar']);
        }
    }

    function loginActSSO(Request $req)
    {
        // pemlap
        if (strpos($req->email, "@") !== false) {
            $getUser = User::where('email', $req->email)->first();
            if ($getUser) {
                if ($getUser->role == "PEMLAP") {
                    // if (Auth::loginUsingId($getUser->id))
                    //     return redirect('/pemlap');
                    return response()->json(['success' => 1, 'message' => 'Login Pemlap'.$getUser->name.'']);
                }
            }
        }
        $response = Http::withHeaders(['token-daspim' => '123'])
            ->get('https://simpeg.polines.ac.id/Dashboard/getPegawaiByKode/' . $req->email);
        $res = $response->json();

        // dosen
        if ($res != null) {
            $checkDosen = Dosen::where('nip', $req->email)->first();
            $checkUser = User::where('email', $req->email)->first();
            if (!$checkDosen && !$checkUser) {
                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['prodi'] == null) {
                        return response()->json(['success' => 0, 'message' => 'Prodi Kosong']);
                    }
                    if ($data['jurusan'] == null) {
                        return response()->json(['success' => 0, 'message' => 'Jurusan Kosong']);
                    }
                    $newUser = new User;
                    $newUser->name = $data['nm_pegawai'];
                    $newUser->email = $data['nip_baru'];
                    $newUser->role = "DOSEN";
                    $newUser->password = bcrypt("123");
                    $newUser->save();

                    $newDosen = new Dosen;
                    $newDosen->nama = $data['nm_pegawai'];
                    $newDosen->email = $data['email_pegawai'];
                    $newDosen->nip = $data['nip_baru'];
                    $newDosen->jenis_kelamin = $data['jenis_kelamin'];
                    $newDosen->nidn = $data['nidn'];
                    $newDosen->alamat_jalan = $data['alamat_jalan'];
                    $newDosen->telepon_pegawai = $data['telepon_pegawai'];
                    $newDosen->jabatan = "Dosen";


                    if ($data['prodi']['nm_jenjang'] == "Diploma 3") {
                        $convJenjang = "Diploma III";
                        $convProdi = str_replace(' (D3)', '', $data['prodi']['nm_prodi']);
                    } else {
                        $convJenjang = $data['prodi']['nm_jenjang'];
                        $convProdi = str_replace(' (S.Tr)', '', $data['prodi']['nm_prodi']);
                    }

                    $newDosen->jenjang = $convJenjang;
                    $newDosen->jurusan = $data['jurusan']['nm_jurusan'];
                    $newDosen->prodi = $convProdi;
                    $newDosen->save();

                    $getUser = User::where('email', $data['nip_baru'])->first();
                    // $check = Auth::loginUsingId($getUser->id);
                    if ($getUser) {
                        if ($getUser->role == "KAPRODI") {
                            return response()->json(['success' => 1, 'message' => 'Login Kaprodi'.$getUser->name.'']);
                        } elseif ($getUser->role == "KAJUR") {
                            return response()->json(['success' => 1, 'message' => 'Login Kajur'.$getUser->name.'']);
                        } elseif ($getUser->role == "PIMPINAN") {
                            return response()->json(['success' => 1, 'message' => 'Login Pimpinan'.$getUser->name.'']);
                        } elseif ($getUser->role == "DOSEN") {
                            return response()->json(['success' => 1, 'message' => 'Login Dosen'.$getUser->name.'']);
                        } elseif ($getUser->role == "ADMIN") {
                            return response()->json(['success' => 1, 'message' => 'Login Admin'.$getUser->name.'']);
                        }
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Pemanggilan API gagal']);
                }
            } elseif ($checkDosen) {
                // $check = Auth::loginUsingId($checkUser->id);
                // if ($check) {
                    if ($checkUser->role == "KAPRODI") {
                        return response()->json(['success' => 1, 'message' => 'Login Kaprodi'.$checkUser->name.'']);
                    } elseif ($checkUser->role == "KAJUR") {
                        return response()->json(['success' => 1, 'message' => 'Login Kajur'.$checkUser->name.'']);
                    } elseif ($checkUser->role == "PIMPINAN") {
                        return response()->json(['success' => 1, 'message' => 'Login Pimpinan'.$checkUser->name.'']);
                    } elseif ($checkUser->role == "DOSEN") {
                        return response()->json(['success' => 1, 'message' => 'Login Dosen'.$checkUser->name.'']);
                    } elseif ($checkUser->role == "ADMIN") {
                        return response()->json(['success' => 1, 'message' => 'Login Admin'.$checkUser->name.'']);
                    }
                // }
            }
        } else {
            $checkMhs = Mahasiswa::where('nim', $req->email)->first();
            if (!$checkMhs) {
                $getToken = Http::post('https://simadu.polines.ac.id/api/login', [
                    "email" => "omahiot@gmail.com",
                    "password" => "Polines#2022"
                ])->json();

                $getMahasiswa = Http::asForm()->withHeaders([
                    'Authorization' => 'Bearer ' . $getToken['data']['token']
                ])->post('https://simadu.polines.ac.id/api/mahasiswa/', [
                    'nim' => $req->email
                ])->json();
                if (empty($getMahasiswa['data'])) {
                    return response()->json(['success' => 0, 'message' => 'mhs gagal']);
                }
                $token = Str::random(36);
                $createUser = User::create([
                    'name' => $getMahasiswa['data'][0]['Nama'],
                    'email' => $getMahasiswa['data'][0]['NIM'],
                    'nim' => $getMahasiswa['data'][0]['NIM'],
                    'password' => bcrypt($req->password),
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'role' => 'MHS'
                ]);
                if ($createUser) {
                    $getUser = User::where('email', $getMahasiswa['data'][0]['NIM'])->first();
                    $createMhs = Mahasiswa::create([
                        'nama' => $getMahasiswa['data'][0]['Nama'],
                        'nim' => $getMahasiswa['data'][0]['NIM'],
                        'telp' => $getMahasiswa['data'][0]['Telepon'],
                        'user_id' => $getUser->id,
                        'prodi' => $getMahasiswa['data'][0]['Program_studi'],
                        'jenjang' => $getMahasiswa['data'][0]['Jenjang'],
                        'jurusan' => $getMahasiswa['data'][0]['Jurusan'],
                        'alamat' => $getMahasiswa['data'][0]['Alamat'],
                        'jenis_kelamin' => $getMahasiswa['data'][0]['Jenis_kelamin']
                    ]);
                    if ($createMhs) {
                        $getUser->token = $token;
                        $getUser->save();
                        return response()->json(['success' => 1, 'message' => 'Login Mhs'.$getUser->name.'']);
                        $checkLogin = Auth::loginUsingId($getUser->id);
                        // if ($checkLogin) {
                        //     return redirect('/mbkm/in');
                        // }
                    }
                }
            } else {
                if ($checkMhs->user->email_verified_at == null) {
                    return response()->json(['success' => 0, 'message' => 'Email belum terverifikasi']);
                } else {
                    return response()->json(['success' => 1, 'message' => 'Login Mhs'.$checkMhs->nama.'']);
                    // $checkLogin = Auth::loginUsingId($checkMhs->user->id);
                    // if ($checkLogin) {
                    //     return redirect('/mbkm/in');
                    // }
                }
            }
        }
    }
}
