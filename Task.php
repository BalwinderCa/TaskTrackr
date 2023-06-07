<?php
class Task {
    private $id;
    private $title;
    private $description;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new task
    public function createTask($title, $description) {
        $stmt = $this->db->getConnection()->prepare('INSERT INTO tasks (title, description) VALUES (?, ?)');
        $stmt->execute([$title, $description]);
    }

    // Read all tasks
    public function getAllTasks() {
        $stmt = $this->db->getConnection()->query('SELECT * FROM tasks');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a task
    public function updateTask($id, $title, $description) {
        $stmt = $this->db->getConnection()->prepare('UPDATE tasks SET title = ?, description = ? WHERE id = ?');
        $stmt->execute([$title, $description, $id]);
    }

    // Delete a task
    public function deleteTask($id) {
        $stmt = $this->db->getConnection()->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
    }
}
