<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #e0e0e0;
            color: #000;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px 0 0 10px;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            border-radius: 50%;
        }

        .sidebar button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #0000ff;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #0000cc;
        }

        .logout {
            margin-top: auto;
            font-size: 16px;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logout:hover {
            color: #0000ff;
        }

        .logout-icon {
            margin-right: 5px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 0 10px 10px 0;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            position: relative;
            width: 50%;
        }

        .search-bar input[type="text"] {
            width: 100%;
            padding: 10px;
            padding-right: 35px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-bar .search-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #aaa;
        }

        .create-task-button {
            background-color: #0000ff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .create-task-button:hover {
            background-color: #0000cc;
        }

        /* Task Stats */
        .task-stats {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 50%;
        }

        .task-stats h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d0d0d0;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
        }

        .stat-value {
            background-color: #e6e6e6;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 18px;
            color: #0000ff;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="https://via.placeholder.com/80" alt="User Icon">
        <button>Dashboard</button>
        <button>Tasks</button>
        <button>Calendar</button>
        <a href="#" class="logout">
            <span class="logout-icon">&#x21a9;</span> Log out
        </a>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <span class="search-icon">&#128269;</span>
            </div>
            <button class="create-task-button">+ Create Task</button>
        </div>

        <div class="task-stats">
            <h2>Task Stats</h2>
            <div class="stat">
                <span>Total Tasks</span>
                <span class="stat-value">20</span>
            </div>
            <div class="stat">
                <span>Pending Tasks</span>
                <span class="stat-value">09</span>
            </div>
            <div class="stat">
                <span>Completed Tasks</span>
                <span class="stat-value">11</span>
            </div>
        </div>
    </div>
</body>
</html>
