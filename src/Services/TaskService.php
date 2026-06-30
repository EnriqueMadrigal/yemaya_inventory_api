<?php
namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService {
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function createTask($data) {
        if (empty($data['title']) || strtotime($data['due_date']) < time()) {
            throw new \Exception('Invalid task title or due date');
        }
        return $this->taskRepository->create($data);
    }
}