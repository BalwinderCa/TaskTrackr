<?php
require 'db.php';
require 'Task.php';

$database = new Database();
$task = new Task($database);

$errors = []; // Initialize the errors array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new task
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Validate form inputs
    if (empty($title)) {
        $errors[] = 'Title is required';
    }

    // If there are no errors, proceed with creating the task
    if (empty($errors)) {
        $task->createTask($title, $description);
    }
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
    <?php if (!empty($errors)) { ?>
        <div class="errors">
            <?php foreach ($errors as $error) { ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>
        </div>
    <?php } ?>
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
