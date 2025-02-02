<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        return People::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:people,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);
        
        return People::create($request->all());
    }

    public function show(int $id)
    {
        return People::find($id);
    }

    public function update(Request $request, int $id)
    {
        return People::find($id)->update($request->all());
    }

    public function destroy(int $id)
    {
        return People::find($id)->delete();
    }
}

