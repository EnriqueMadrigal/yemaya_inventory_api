<?php
namespace App\Controllers;

use App\Services\TaskService;

class TaskController {
    private $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    public function getTasks() {
        $tasks = $this->taskService->getAllTasks();
        header('Content-Type: application/json');
        echo json_encode(['data' => $tasks]);
    }
}
