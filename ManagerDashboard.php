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
            <button class="btn" type="button" onclick="redirectToTaskList()">Task</button>
            <button class="btn" type="button" onclick="redirectToTask()">Create New Task</button>
        </div>
    </div>

    <!-- Header -->
    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="profile_btn">
            <img id="profile_icon" src="Profile_icon.svg" alt="Icon not found!">
        </button>
    </div>

    <!-- Task Statistics -->
    <div id="stats">
        <h1 id="tsk_sts">Task Stats</h1>
        <div class="t_detail">

            <!-- Display Task Statistics -->
            <div class="t_count">
                <h2>Total Tasks</h2>
                <input type="text" id="total_box" value="" disabled>
            </div>
            <div class="t_count">
                <h2>Pending Tasks</h2>
                <input type="text" id="pending_box" value="" disabled>
            </div>
            <div class="t_count">
                <h2>Complete Tasks</h2>
                <input type="text" id="complete_box" value="" disabled>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="ManagerDashboard.js"></script>
</body>

</html>
