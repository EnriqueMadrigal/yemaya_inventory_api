<?php
namespace App\Repositories;

class TaskRepository {
    private $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function create($data) {
        $stmt = $this->db->prepare('INSERT INTO tasks (title, due_date) VALUES (:title, :due_date)');
        $stmt->execute(['title' => $data['title'], 'due_date' => $data['due_date']]);
        return $this->db->lastInsertId();
    }
}