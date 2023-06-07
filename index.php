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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        /* Custom styles (optional) */
        .task-form {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Task Management System</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Add Task</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <h2>Tasks</h2>
                <?php if (count($tasks) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                    </div>
                <?php } else { ?>
                    <p>No tasks found.</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

