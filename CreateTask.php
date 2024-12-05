<?php
// Include the database connection file
include("db_connection.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $taskTitle = $conn->real_escape_string($_POST['taskTitle']);
    $taskDescription = $conn->real_escape_string($_POST['taskDescription']);
    $assignee = $conn->real_escape_string($_POST['assignee']);
    $dueDate = $conn->real_escape_string($_POST['dueDate']);
    $priority = $conn->real_escape_string($_POST['priority']);

    // Validate data
    if (empty($taskTitle) || empty($dueDate) || empty($priority)) {
        echo "<script>alert('Please fill all required fields!');</script>";
    } else {
        // Insert task into the database
        $sql = "INSERT INTO Tasks (title, description, priority, due_date)
                VALUES ('$taskTitle', '$taskDescription', '$priority', '$dueDate')";

        if ($conn->query($sql) === TRUE) {
            $taskId = $conn->insert_id; // Get the ID of the inserted task

            // Assign task to employee
            if (!empty($assignee)) {
                $sqlAssign = "INSERT INTO TaskTeamMembers (task_id, employee_id) 
                              VALUES ('$taskId', '$assignee')";

                if ($conn->query($sqlAssign) !== TRUE) {
                    echo "<script>alert('Task created but failed to assign employee!');</script>";
                }
            }

            echo "<script>alert('Task created successfully!');</script>";
        } else {
            echo "<script>alert('Error creating task: " . $conn->error . "');</script>";
        }
    }
}

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
        <button type="button" id="Logout" onclick="redirectToLogin()">Log Out</button>
    </div>
    <div id="Tasks">
        <form action="" method="POST" id="TaskForm">
            <h2 id="TaskHeading">Create New Task</h2>
            <div id="TaskEntery">
                <label for="taskTitle">Task Title</label>
                <input type="text" class="Input" name="taskTitle" required>
                <label for="taskDescription">Description</label>
                <textarea id="taskDescription" class="Input" name="taskDescription" required></textarea>
                <label for="assignee">Assign To</label>
                <select id="assignee" class="Input" name="assignee" required>
                    <option value="">Select Assignee</option>
                    <?php
                    // Fetch available employees from the database
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $result = $conn->query("SELECT user_id, full_name FROM AvailableEmployees");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['user_id'] . "'>" . $row['full_name'] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
                <label for="dueDate">Due Date</label>
                <input id="dueDate" type="date" class="Input" name="dueDate" required>
                <label for="priority">Priority</label>
                <select id="priority" class="Input" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
                <button type="submit" id="submit-btn">Create Task</button>
            </div>
        </form>
    </div>
    <script src="CreateTask.js"></script>
</body>

</html>