<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return History::all();
    }

    public function store(Request $request)
    {
        return History::create($request->all());
    }

    public function show(int $id)
    {
        return History::find($id);
    }

    public function update(Request $request, int $id)
    {
        return History::find($id)->update($request->all());
    }

    public function destroy(int $id)
    {
        return History::find($id)->delete();
    }
}

