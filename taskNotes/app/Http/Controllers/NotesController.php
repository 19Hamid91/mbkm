<?php

namespace App\Http\Controllers;
use App\Models\Notes;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        
        return view('index');
    }
    public function create()
    {
        return view('create');
    }
    public function store()
    {
        return redirect('index');
    }
    public function edit()
    {
        return view('edit');
    }
    public function update()
    {
        return redirect('index');
    }
    public function show($id)
    {
        return view('show');
    }
    public function destroy()
    {
        return redirect('index');
    }
    
}
