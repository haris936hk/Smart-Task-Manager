<?php
include('auth.php');

// Include database connection
include('db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminDashboard.css">
    <title>PasswordHashing</title>
</head>

<body>
    <div id="container">
        <div id="buttons">
            <button name="Createbtn" class="ActionButton" onclick="redirectToCreateAccount()">Create Account</button>
            <button name="Updatebtn" class="ActionButton" onclick="redirectToUpdateAccount()"> Update Account </button>
            <button name="Deletebtn" class="ActionButton" onclick="redirectToDeleteAccount()"> Delete Account </button>
            <button name="Resetbtn" class="ActionButton" onclick="redirectToResetPassword()"> Reset Password </button>
            <button name="Resetbtn" class="ActionButtonlogout" onclick="window.location.href='logout.php')"> LogOut </button>
        </div>
    </div>
    <script src="AdminDashboard.js"></script>
</body>

</html>
