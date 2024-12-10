<?php
// Include the authentication file
include('auth.php');

// Include the database connection file
include('db_connection.php');

// Get the employee's ID from the session
$employee_id = $_SESSION['user_id'];

// Fetch task statistics for the logged-in employee
$totalTasksQuery = "
    SELECT COUNT(*) AS total 
    FROM Tasks t
    JOIN TaskTeamMembers ttm ON t.task_id = ttm.task_id
    WHERE ttm.employee_id = ?";
    
$pendingTasksQuery = "
    SELECT COUNT(*) AS inprogress 
    FROM Tasks t
    JOIN TaskTeamMembers ttm ON t.task_id = ttm.task_id
    WHERE ttm.employee_id = ? AND t.status = 'In Progress'";

$completedTasksQuery = "
    SELECT COUNT(*) AS completed 
    FROM Tasks t
    JOIN TaskTeamMembers ttm ON t.task_id = ttm.task_id
    WHERE ttm.employee_id = ? AND t.status = 'Completed'";

// Prepare and execute the total tasks query
$stmt = $conn->prepare($totalTasksQuery);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$totalTasksResult = $stmt->get_result();
$totalTasks = $totalTasksResult->fetch_assoc()['total'];

// Prepare and execute the pending tasks query
$stmt = $conn->prepare($pendingTasksQuery);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$pendingTasksResult = $stmt->get_result();
$pendingTasks = $pendingTasksResult->fetch_assoc()['inprogress'];

// Prepare and execute the completed tasks query
$stmt = $conn->prepare($completedTasksQuery);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$completedTasksResult = $stmt->get_result();
$completedTasks = $completedTasksResult->fetch_assoc()['completed'];

// Close the statement and database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EmployeeDashboard.css">
    <title>Employee Dashboard</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
        </div>
    </div>

    <!-- Header -->
    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="submit" id="Logout" onclick="window.location.href='logout.php'">Log Out</button>

    </div>

    <!-- Task Statistics Section -->
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

    <script src="EmployeeDashboard.js"></script>
</body>

</html>
