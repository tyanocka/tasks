<?php

namespace App\Http\Controllers;

use App\Models\Task;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        if ($request->date) {
            $tasks = $tasks->where('created_at', $request->date);
        }
        if ($request->status) {
            $tasks = $tasks->where('status_id', $request->status);
        }

        $data = [];
        foreach ($tasks as $task) {
            $data[] = [
                "name" => $task->name,
                "description" => $task->description,
                "status_id" => $task->status_id,
                "created_at" => $task->created_at
            ];
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->name)) {
            Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'status_id' => $request->status,
                "created_at" => date('Y-m-d')
            ]);
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (isset($request->id)) {
            $task = Task::find($request->id);
            $task->update($request->all());
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $task = Task::find($request->id);
            $task->delete();
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 400);
        }
    }
}
