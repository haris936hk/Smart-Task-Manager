<?php
// Start session
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Employee') {
    header('Location: login.php');
    exit;
}

// Include database connection
include('db_connection.php');

// Get the employee's ID from the session
$employee_id = $_SESSION['user_id'];

// Fetch tasks assigned to the logged-in employee
$sql = "
    SELECT 
        t.task_id, 
        t.title, 
        t.priority, 
        t.status, 
        t.due_date
    FROM 
        Tasks t
    JOIN 
        TaskTeamMembers ttm ON t.task_id = ttm.task_id
    WHERE 
        ttm.employee_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

// Handle task status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_id']) && isset($_POST['status'])) {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    // Update task status in the database
    $update_sql = "UPDATE Tasks SET status = ? WHERE task_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $status, $task_id);
    $update_stmt->execute();

    // Close the statement after execution
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EmployeeTasklist.css">
    <title>EmployeeTaskList</title>
</head>

<body>
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
        </div>
    </div>

    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <form action="logout.php" method="POST">
            <button type="submit" id="Logout">Log Out</button>
        </form>
    </div>

    <div id="Tasks">
        <table>
            <tr>
                <th id="title" colspan="5">
                    <h2 id="titleHeading">Task List</h2>
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Deadline</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                $task_no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='task-".$row['task_id']."'>";
                    echo "<td>" . $task_no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['priority']) . "</td>";
                    echo "<td><input type='checkbox' " . ($row['status'] == 'Completed' ? 'checked' : '') . " 
                    onclick='updateTaskStatus(" . $row['task_id'] . ", this.checked)' 
                    id='status-" . $row['task_id'] . "'></td>";
                    echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No tasks assigned</td></tr>";
            }
            ?>
        </table>
    </div>

    <script src="EmployeeTaskList.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
