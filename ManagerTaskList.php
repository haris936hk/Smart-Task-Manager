<?php
// Database connection
include('db_connection.php');

// Fetch tasks and team member details
$sql = "SELECT * FROM TaskDetailsWithTeam";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ManagerTasklist.css">
    <title>ManagerTaskList</title>
</head>

<body>
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Create New Task</button>
        </div>
    </div>

    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="Logout" onclick="redirectToLogin()">Log Out</button>
    </div>

    <div id="Tasks">
        <table>
            <tr>
                <th id="title" colspan="8">
                    <h2 id="titleHeading">Task List</h2>
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Task Title</th>
                <th>Priority</th>
                <th>Assignee</th>
                <th>Status</th>
                <th>Deadline</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                $task_no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $task_no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['priority']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['team_members']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No tasks available</td></tr>";
            }
            ?>
        </table>
    </div>

    <script src="ManagerTaskList.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
