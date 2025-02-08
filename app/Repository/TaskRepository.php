<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository implements ITaskRepository
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::find($id);
        
        if ($task) {
            $task->update($data);
        }

        return $task;
    }

    public function showAll(Task $task) 
    {
        $task = Task::all();
        return $task;
    }

    public function show(Task $task, $id) {
        $task = Task::find($id);

        return $task;
    }

    public function submitTask(array $task, $id) {
        $task = Task::find($id);
        //we might want to check the type of task before saving it.
        $task->instagram_url = $data['instagram_url'];
        $task->screenshot = $data['screenshot'];
        $task->save();
        return $task;
    }

    public function approveTask($id) {
        $task = Task::find($id);
        $task->status = 'approved';
        $task->save();

        $user = $task->user;
        $user->balance += $task->task_amount;
        $user->save();
        return $task;
    }

}