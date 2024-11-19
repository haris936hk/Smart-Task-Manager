<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminDashboard.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="SelectRol">
        <img id="Rolimg" src="Logo.png" alt="Image not found!">

        <button name="Mngbtn" class="Rolbtn" onclick="showForm()"> Manager </button>
        <button name="Empbtn" class="Rolbtn" onclick="showForm()"> Employee Account </button>
    </div>

    <div id="container">
        <div id="buttons">
            <button name="Empbtn" class="ActionButton" onclick="redirectToCreatAccount()"> Creat Account </button>
            <button name="Empbtn" class="ActionButton" onclick="redirectToUpdateAccount()"> Update Account </button>
            <button name="Empbtn" class="ActionButton" onclick="redirectToDeleteAccount()"> Delete Account </button>
            <button name="Empbtn" class="ActionButton" onclick="redirectToResetPassword()"> Reset Password </button>
        </div>
    </div>
    <script src="AdminDashboard.js"></script>
</body>

</html>