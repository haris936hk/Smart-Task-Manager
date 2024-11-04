<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ManagerDashboard.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            /* Added flex properties for centering */
            display: none;
            justify-content: center;
            align-items: center;
            overflow-y: auto; /* Enable scrolling if needed */
            margin-left: ;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
            /* Remove margin-top and use max-height */
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Add smooth scrollbar for the modal content */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #d3d3d3;
            border-radius: 10px;
            font-size: 16px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .submit-btn {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        /* Add spacing for the form title */
        .modal-title {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
            padding-top: 10px;
        }
    </style>
    <title>ManagerDashboard</title>
</head>
<body>
     <div class="bar">
        <img class="logo" src="Logo.png" alt="Image not found!">
        <div class="inbar">
            <button id="btn" type="button">Dashboard</button>
            <button id="btn" type="button">Task</button>
            <button id="btn" type="button">Calendar</button>
        </div>
        <hr class="line">
        <button class="logout"><img class="out" src="logout.svg" alt="Icon not found">Sign out</button>
    </div>

    <div class="Navbar">
        <div class="search-container">
            <form class="search-container" action="/search" method="get">
                <input type="text" placeholder="Search">
                <button type="submit" class="search-icon-btn"><img class="search_icon" src="Search_icon.svg" alt="Icon not fount!"></button>
            </form>
        </div>
        
        <button type="button" id="plus_btn" onclick="openModal()"><img id="plus_icon" src="plus.svg" alt="Icon not found!">Create Task</button>
        <button type="button" id="profile_btn"><img id="profile_icon" src="Profile_icon.svg" alt="Icon not found!"></button>
    </div>
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Create New Task</h2>
            <form id="taskForm">
                <div class="form-group">
                    <label for="taskTitle">Task Title</label>
                    <input type="text" id="taskTitle" name="taskTitle" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Description</label>
                    <textarea id="taskDescription" name="taskDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="assignee">Assign To</label>
                    <select id="assignee" name="assignee" required>
                        <option value="">Select Assignee</option>
                        <option value="employee1">Employee 1</option>
                        <option value="employee2">Employee 2</option>
                        <option value="employee3">Employee 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dueDate">Due Date</label>
                    <input type="date" id="dueDate" name="dueDate" required>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select id="priority" name="priority" required>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Create Task</button>
            </form>
        </div>
    </div>

    <div id="stats">
        <h1 id="tsk_sts">Task Stats</h1>
        <div class="t_detail">
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
   <script>
        // Get the modal elements
        const modal = document.getElementById("taskModal");
        const createTaskBtn = document.getElementById("plus_btn");
        const closeBtn = document.getElementsByClassName("close")[0];
        const taskForm = document.getElementById("taskForm");

        // Open modal when Create Task button is clicked
        createTaskBtn.onclick = function() {
            modal.style.display = "block";
        }

        // Close modal when X is clicked
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Handle form submission
        taskForm.onsubmit = function(e) {
            e.preventDefault();
            
            // Get form values
            const formData = {
                title: document.getElementById("taskTitle").value,
                description: document.getElementById("taskDescription").value,
                assignee: document.getElementById("assignee").value,
                dueDate: document.getElementById("dueDate").value,
                priority: document.getElementById("priority").value
            };

            // Here you would typically send the data to your backend
            console.log("Task Created:", formData);
            
            // Update task stats (you'll need to implement the actual logic)
            const totalTasks = document.getElementById("total_box");
            const pendingTasks = document.getElementById("pending_box");
            if (totalTasks.value === "") totalTasks.value = 0;
            if (pendingTasks.value === "") pendingTasks.value = 0;
            
            totalTasks.value = parseInt(totalTasks.value) + 1;
            pendingTasks.value = parseInt(pendingTasks.value) + 1;

            // Close the modal and reset form
            modal.style.display = "none";
            taskForm.reset();
        }
    </script>


</body>
</html>
