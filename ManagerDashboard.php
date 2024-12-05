<?php
// Include the database connection file
include('db_connection.php');

// Fetch task statistics
$totalTasksQuery = "SELECT COUNT(*) AS total FROM Tasks";
$pendingTasksQuery = "SELECT COUNT(*) AS inprogress FROM Tasks WHERE status = 'In Progress'";
$completedTasksQuery = "SELECT COUNT(*) AS completed FROM Tasks WHERE status = 'Completed'";

$totalTasksResult = $conn->query($totalTasksQuery);
$pendingTasksResult = $conn->query($pendingTasksQuery);
$completedTasksResult = $conn->query($completedTasksQuery);

// Fetch the values from the results
$totalTasks = $totalTasksResult->fetch_assoc()['total'];
$pendingTasks = $pendingTasksResult->fetch_assoc()['inprogress'];
$completedTasks = $completedTasksResult->fetch_assoc()['completed'];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ManagerDashboard.css">
    <title>Manager Dashboard</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
            <button class="btn" type="button" onclick="redirectToTask()">Create New Task</button>
        </div>
    </div>

    <!-- Header -->
    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="Logout" onclick="redirectToLogin()">Log Out</button>
    </div>

    <!-- Task Statistics -->
    <div id="stats">
        <h1 id="tsk_sts">Task Stats</h1>
        <div class="t_detail">

            <!-- Display Task Statistics -->
            <div class="t_count">
                <h2>Total Tasks</h2>
                <input type="text" id="total_box" value="<?php echo $totalTasks; ?>" disabled>
            </div>
            <div class="t_count">
                <h2>Pending Tasks</h2>
                <input type="text" id="pending_box" value="<?php echo $pendingTasks; ?>" disabled>
            </div>
            <div class="t_count">
                <h2>Complete Tasks</h2>
                <input type="text" id="complete_box" value="<?php echo $completedTasks; ?>" disabled>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="ManagerDashboard.js"></script>
</body>

</html>
