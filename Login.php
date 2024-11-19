<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>PasswordHashing</title>
</head>
<body>
    <div id="login">

        <img id= "img" src="Logo.png" alt="Image not found!">

        <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>
            <label for="inputbox" class="lbl">Enter User Name</label> <br>
            <input type="text" name="nm" id="inputbox" placeholder="Username"> <br><br>
            <label for="Passinputbox" class="lbl">Enter Password</label> <br>
            <input type="password" name="pswd" id="Passinputbox" placeholder="Password"> <br>
            <input id="check" type="checkbox" onclick="myFunction()">
            <label for="check" id="Showpassword">Show Password</label>

            <button name= "btn" id = "btn" > Login </button>
        </form>
    </div>

    <script src="Login.js"></script>
</body>
</html>
