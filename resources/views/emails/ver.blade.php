<x-mail::message>
@if ($type=="ver")
    # Email Verifikasi
    Email ini hanya dapat digunakan satu kali setelah dijalankan
@else
    # Email Reset Password
    Email ini hanya dapat digunakan satu kali setelah dijalankan
@endif

<x-mail::button :url="$url">
@if ($type=="ver")
Verifikasi
@else
Reset
@endif
</x-mail::button>

</x-mail::message>
