<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EmployeeTasklist.css">
    <!-- <script src="EmployeeTaskList.js"></script> -->
    <title>EmployeeTaskList</title>
</head>
<body>
     <div class="bar">
            <img class="logo" src="Logo.png" alt="Image not found!">
            <div class="inbar">
                <button class="btn" type="button">Dashboard</button>
                <button class="btn" type="button">Task</button>
                <button class="btn" type="button">Calendar</button>
            </div>
            <hr class="line">
            <button class="logout"><img class="out" src="logout.svg" alt="Icon not found">Sign out</button>
    </div>

    <div class="Navbar">
        <div class="search-container">
            <form class="search-container" action="/search" method="get">
                <input type="text" placeholder="Search">
                <button type="submit" class="search-icon-btn"><img class="search_icon" src="Search_icon.svg" alt="Icon not found!"></button>
            </form>
        </div>

        <div id="btn_box">
            <button type="button" id="profile_btn"> <img id="profile_icon" src="Profile_icon.svg" alt="Icon not found!"></button>
        </div>
    </div>

    <div id="Tasks">
        <table>
            <tr>
                <th id="title" colspan="8">
                    <h2>Task List</h2>
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Team Members</th>
                <th>Notes</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="text" placeholder="dd/mm/yyyy" class="deadline-input" disabled></td>
                <td></td>
                <td></td>
                <td><button class="Member-button" onclick="togglePopup('Members')">Members</button></td>
                <td><button class="Notes-button" onclick="togglePopup('Notes')">Notes</button></td>
            </tr>
            <!-- Repeat rows as needed -->
        </table>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="togglePopup()">&times;</span>
            <h3 id="popup-title">Popup Title</h3>
            <p>Content from database or other details will go here.</p>
        </div>
    </div>

    <script>
        function togglePopup(title) {
            const popup = document.getElementById('popup');
            const popupTitle = document.getElementById('popup-title');
            if (title) {
                popupTitle.textContent = title;
                popup.style.display = 'block';
            } else {
                popup.style.display = 'none';
            }
        }
    </script>
</body>
</html>
