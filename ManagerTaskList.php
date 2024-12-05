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
            <button class="btn" type="button" onclick="redirectToTaskList()">Task List</button>
        </div>
    </div>

    <div class="Navbar">
        <h1 id="heading">Smart Task Manager</h1>
        <button type="button" id="profile_btn"><img id="profile_icon" src="Profile_icon.svg"
                alt="Icon not found!"></button>
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
                <th>Employee</th>
                <th>Notes</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td>
                    <button class="Member-button" onclick="togglePopupe('membersPopup')">Employees</button>
                    <div class="overlay" id="overlay-members" onclick="togglePopupe('membersPopup')"></div>
                    <div class="popup" id="membersPopup">
                        <h3>Members</h3>
                        <ul class="scrollable-list">
                            <li>Employee-01</li>
                            <li>Employee-02</li>
                            <li>Employee-03</li>
                            <li>Employee-04</li>
                            <li>Employee-05</li>
                        </ul>
                    </div>
                </td>
                <td>
                    <button class="Notes-button" onclick="togglePopup('notesPopup')">Notes</button>
                    <div class="overlay" id="overlay-notes" onclick="togglePopup('notesPopup')"></div>
                    <div class="popup" id="notesPopup">
                        <h3>Add Note</h3>
                        <textarea placeholder="Add Note here"></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Employees</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <!-- Repeat rows as needed -->
        </table>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="togglePopup()">&times;</span>
            <h3 id="popup-title">Popup Title</h3>
            <ul id="popup-list">
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input"
                        disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input"
                        disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input"
                        disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input"
                        disabled></li>
                <li class="popup-list-item"><input type="text" placeholder="Member Name" class="deadline-input"
                        disabled></li>
            </ul>
        </div>
    </div>

    <script src="ManagerTaskList.js"></script>
</body>

</html>