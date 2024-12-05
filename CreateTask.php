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
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
            <button class="btn" type="button" onclick="redirectToCreateTask()">Create New Task</button>
        </div>
    </div>
    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="Logout">Log Out</button>
    </div>

    <div id="Tasks">
        <form action="" method="POST" id="TaskForm">
            <h2 id="TaskHeading">Create New Task</h2>

            <div id="TaskEntery">
                    <label for="taskTitle" >Task Title</label>
                    <input type="text" class="Input" name="taskTitle" required>

                    <label for="taskDescription">Description</label>
                    <textarea id="taskDescription" class="Input" name="taskDescription" required></textarea>

                    <label for="assignee">Assign To</label>
                    <select id="assignee" class="Input" name="assignee" required>
                        <option value="">Select Assignee</option>
                        <option value="employee1">Employee 1</option>
                        <option value="employee2">Employee 2</option>
                        <option value="employee3">Employee 3</option>
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
    </div>



    <script src="CreateTask.js"></script>
</body>

</html>