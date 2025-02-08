<?php

namespace App\Repository;

use App\Models\Task;

interface ITaskRepository
{
    public function create(array $data): Task;
    public function update($id, array $data);
    //public function delete(Task $task);
    public function showAll(Task $task);
    public function show(Task $task, $id);
    public function submitTask(array $task, $id);
    public function approveTask($id);
}