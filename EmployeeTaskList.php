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
        <button type="button" id="Logout">Log Out</button>
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
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" id="myCheckbox">
                <label for="myCheckbox">Task Complete</label></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
            </tr>
        </table>
    </div>

    <script src="EmployeeTaskList.js"></script>
</body>

</html>