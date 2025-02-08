<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Repository\ITaskRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected $task;

    public function __construct(ITaskRepository $task)
    {
        $this->task = $task;
    }

    public function createTask(Request $request) {
        $validateTask = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'task_amount' => 'nullable|integer',
            'task_type' => 'required|integer',
            'task_count_total' => 'nullable|integer',
            'task_count_remaining' => 'nullable|integer',
            'platforms' => 'nullable|string',
        ]);

        if ($validateTask->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validateTask->errors(),
            ], 422); 
        }

        $task = $this->task->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);

    }

    public function updateTask(Request $request, $id) {
        $validateTask = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'task_amount' => 'nullable|integer',
            'task_type' => 'required|integer',
            'task_count_total' => 'nullable|integer',
            'task_count_remaining' => 'nullable|integer',
            'platforms' => 'nullable|string',
        ]);

        if ($validateTask->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validateTask->errors(),
            ], 422);

        }

        $validatedData = $validateTask->validated();
        $task = $this->task->update($id, $validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ], 200);

    }

    public function showAll(Task $task)
    {
        $tasks = $this->task->showAll($task);

        return response()->json([
            'status' => true,
            'message' => 'Task retrieved successfully',
            'data' => $tasks,
        ], 200);
    }

    public function show(Task $task, $id)
    {
        $task = $this->task->show($task, $id);

        return response()->json([
            'status' => true,
            'message' => 'Task retrieved successfully',
            'data' => $task,
        ], 200);
    }

    public function submitTask(Request $request, $id) {
        $task = $this->task->submitTask($request->all(), $id);        
        return response()->json([
            'status' => true,
            'message' => 'Task submitted successfully',
            'data' => $task,
        ]);
    }

    public function approveTask($id) {
        $task = $this->task->approveTask($id);        
        return response()->json([
            'status' => true,
            'message' => 'Task approved successfully',
            'data' => $task,
        ]);
    }
}
