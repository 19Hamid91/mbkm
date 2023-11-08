<?php

namespace App\Http\Controllers;
use App\Models\Notes;

use Illuminate\Http\Request;

class ApiNotesController extends Controller
{
    public function index()
    {
        $data = Notes::all();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $data = Notes::create($request->all());
        return response()->json($data, 201);
    }
    public function update(Request $request, $id)
    {
        $data = Notes::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }
    public function show($id)
    {
        $data = Notes::findOrFail($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = Notes::findOrFail($id);
        $data->delete();
        return response()->json(null, 204);
    }
    
}
