<?php
// db_connection.php: Database connection (Make sure this file contains your DB connection details)
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $taskTitle = $_POST['taskTitle'];
    $taskDescription = $_POST['taskDescription'];
    $dueDate = $_POST['dueDate'];
    $priority = $_POST['priority'];
    $assignedEmployees = $_POST['employees']; // Array of employee IDs

    // Check if the form data is valid
    if (!empty($taskTitle) && !empty($taskDescription) && !empty($dueDate) && !empty($priority)) {
        // Step 1: Insert Task into Tasks Table
        $sql = "INSERT INTO Tasks (title, description, priority, status, due_date) 
                VALUES (?, ?, ?, 'Pending', ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $taskTitle, $taskDescription, $priority, $dueDate);
        
        if ($stmt->execute()) {
            // Get the task_id of the newly created task
            $task_id = $conn->insert_id;

            // Step 2: Assign Employees to the Task (Insert into TaskTeamMembers table)
            foreach ($assignedEmployees as $employee_id) {
                $sql_assign = "INSERT INTO TaskTeamMembers (task_id, employee_id) VALUES (?, ?)";
                $stmt_assign = $conn->prepare($sql_assign);
                $stmt_assign->bind_param("ii", $task_id, $employee_id);
                $stmt_assign->execute();
            }

            // Success message (You can redirect to task list or show a success message)
            $success_message = "Task created successfully!";
        } else {
            $error_message = "Error creating task: " . $conn->error;
        }
    } else {
        $error_message = "Please fill in all the fields.";
    }
}

// Fetch active employees from the database
$result = $conn->query("SELECT user_id, full_name FROM Users WHERE role = 'Employee' AND is_active = 1");

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CreateTask.css">
    <title>Create Task</title>
</head>

<body>
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task</button>
            <button class="btn" type="button" onclick="redirectToTask()">Create New Task</button>
        </div>
    </div>

    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="profile_btn"><img id="profile_icon" src="Profile_icon.svg"
                alt="Icon not found!"></button>
    </div>

    <div id="Tasks">
        <form action="" method="POST" id="TaskForm">
            <h2 id="TaskHeading">Create New Task</h2>

            <div id="TaskEntery">
                    <label for="taskTitle" >Task Title</label>
                    <input type="text" class="Input" name="taskTitle" required>

                    <label for="taskDescription">Description</label>
                    <textarea id="taskDescription" class="Input" name="taskDescription" required></textarea>

                    <label for="employee">Assign To</label>
                    <select id="employee" class="Input" name="employees[]" multiple required>
                        <!-- Populate dynamically with PHP -->
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['user_id'] . "'>" . $row['full_name'] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="dueDate">Due Date</label>
                    <input id="dueDate" type="date" class="Input" name="dueDate" required>

                    <label for="priority">Priority</label>
                    <select id="priority" class="Input" name="priority" required>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>

                <button type="submit" id="submit-btn">Create Task</button>
            </div>
        </form>

        <?php if (isset($success_message)) { ?>
            <div class="success-message">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php } ?>

        <?php if (isset($error_message)) { ?>
            <div class="error-message">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php } ?>
    </div>

    <script src="CreateTask.js"></script>
</body>

</html>
