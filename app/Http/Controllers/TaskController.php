<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');

    }

    public function listData(Request $request): JsonResponse
    {
        $start = $request->has('start') && $request->start > 0 ? $request->start : 0;
        $length = $request->has('length') ? $request->length : 10;
        $draw = $request->has('draw') ? $request->draw : 1;
        $page = $start / $length + 1;
        $search = $request->has('search') ? $request->search['value'] : '';

        $api = Task::query();
        if ($search != '') {
            $api->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->orWhere('due_date', 'LIKE', '%' . $search . '%');
        }

        $data = $api->orderBy('priority', 'desc')->paginate($length, ['*'], 'page', $page);
        return response()->json(array(
            'draw' => $draw,
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => collect($data),
        ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request )
    {
        Task::query()->create($request->all());
        return response()->json(['success' => true, 'message' => 'Task created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::query()->where('id', '=', $id)->first();
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::query()->where('id', '=', $id)->first();
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $task = Task::query()->findOrFail($id);
        $task->title = $request->title;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->description = $request->description;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::query()->findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task Deleted Successfully');
    }
}
