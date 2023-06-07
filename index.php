<?php
require 'db.php';
require 'Task.php';

$database = new Database();
$task = new Task($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new task
    $title = $_POST['title'];
    $description = $_POST['description'];
    $task->createTask($title, $description);
}

$tasks = $task->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Management System</title>
</head>
<body>
    <h1>Task Management System</h1>
    
    <h2>Add Task</h2>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <button type="submit">Add Task</button>
    </form>
    
    <h2>Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) { ?>
                <tr>
                    <td><?php echo $task['title']; ?></td>
                    <td><?php echo $task['description']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
