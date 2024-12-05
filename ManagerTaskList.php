<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ManagerTasklist.css">
    <title>EmployeeTaskList</title>
</head>

<body>
    <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button class="btn" type="button" onclick="redirectToDashboard()">Dashboard</button>
            <button class="btn" type="button" onclick="redirectToTaskList()">Task</button>
            <button class="btn" type="button" onclick="redirectToCalender()">Create New Task</button>
        </div>
    </div>

    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="profile_btn"><img id="profile_icon" src="Profile_icon.svg" alt="Icon not found!"></button>
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
                <th>Name</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Team Members</th>
                <th>Notes</th>
            </tr>

            <?php
            // Database connection
            $con = mysqli_connect("localhost", "root", "", "smarttaskmanager");

            // Check connection
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch tasks from the database
            $sql = "SELECT * FROM Tasks";
            $result = mysqli_query($con, $sql);

            // Check if there are tasks
            if (mysqli_num_rows($result) > 0) {
                $task_no = 1; // Initialize task number
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $task_no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['priority']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars(date("d/m/Y", strtotime($row['deadline']))) . "</td>";

                    // Dummy data for Team Members and Notes buttons
                    echo '<td><button class="Member-button" onclick="togglePopup(\'Members\')">Members</button></td>';
                    echo '<td><button class="Notes-button" onclick="togglePopup(\'Notes\')">Notes</button></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No tasks found</td></tr>";
            }

            // Close the database connection
            mysqli_close($con);
            ?>
        </table>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="togglePopup()">&times;</span>
            <h3 id="popup-title">Popup Title</h3>
            <ul id="popup-list">
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input" disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input" disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input" disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input" disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input" disabled></li>
            </ul>
        </div>
    </div>

    <script src="ManagerTaskList.js"></script>
</body>

</html>
