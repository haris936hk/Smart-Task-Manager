<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EmployeeDashboard.css">
    <title>Employee Dashboard</title>
</head>
<body>
     <div class="bar">
            <img class="logo" src="Logo.png" alt="Image not found!">

            <div class="inbar">
                <button id = "btn" type = "button">Dashboard</button>
                <button id = "btn" type = "button">Task</button>
                <button id = "btn" type = "button">Calendar</button>
            </div>

            <hr class="line">
            
                <button class = "logout"><img class = "out" src="logout.svg" alt="Icon not found">Sign out</button>
            
    </div>

        <div class="Navbar">
            <div class="search-container">
                <form class="search-container" action="/search" method="get">
                    <input type="text" placeholder="Search">
                    <button type="submit" class="search-icon-btn"><img class = "search_icon" src="Search_icon.svg" alt="Icon not fount!"></button>
                </form>
            </div>
            
            <button type= "button" id= "plus_btn"><img id ="plus_icon"src="plus.svg" alt="Icon not found!">Create Task</button>
            <button type= "button" id= "profile_btn"> <img id ="profile_icon"src="Profile_icon.svg" alt="Icon not found!"></button>
        </div>


        <div id="stats">
            <h1 id="tsk_sts">Task Stats</h1>

            <div class="t_detail">

                <div class="t_count">
                    <h2>Total Tasks</h2>
                    <input type="tex" id="total_box" value="" disabled>
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


</body>
</html>