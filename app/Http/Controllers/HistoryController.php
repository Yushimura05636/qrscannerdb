<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\People;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return History::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
                'datetime' => 'required|date',
                'person_id' => 'required|integer'
            ]);

            $history = History::create($validated);
            
            return response()->json($history, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create history record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id)
    {
        return History::where('person_id', $id)->get();
    }

    public function update(Request $request, int $id)
    {
        return History::find($id)->update($request->all());
    }

    public function destroy(int $id)
    {
        return History::find($id)->delete();
    }

    public function historyScan()
    {
        //This function is used to get the total scan, total time in, and total time out
        $TotalScan = History::count();
        $TotalRegistered = People::count();
        $TotalTimeIn = History::where('description', 'time in')->count();
        $TotalTimeOut = History::where('description', 'time out')->count();
        return response()->json(['total_scan' => $TotalScan, 'total_time_in' => $TotalTimeIn, 'total_time_out' => $TotalTimeOut, 'total_registered' => $TotalRegistered]);
    }
}

