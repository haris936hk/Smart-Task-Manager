<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SignUp.css">
    <title>PasswordHashing</title>
</head>
<body>

        <div id="SelectRol">
            <img id= "Rolimg" src="Logo.png" alt="Image not found!">

            <button name= "Mngbtn" id = "Rolbtn" onclick="showForm()"> Manager </button>
            <button name= "Empbtn" id = "Rolbtn" onclick="showForm()"> Employee Account </button>
        </div>

    <div id = "container">

    <img id= "SignUpimg" src="Logo.png" alt="Image not found!">

        <div id="SignUp">

            <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>

                <label for="inputbox" class="lbl"> User ID </label> <br>
                <input type="text" name="id" id="inputbox" placeholder="User ID" disabled> <br><br>
            
                <label for="inputbox" class="lbl">Enter Full Name </label> <br>
                <input type="text" name="nm" id="nminputbox" placeholder="Username"> <br><br>

                <label for="inputbox" class="lbl">Enter Email Address </label> <br>
                <input type="text" name="cnic" id="mailinputbox" placeholder="Email Addres"> <br><br>

                <label for="Passinputbox" class="lbl">Enter Password</label> <br>
                <input type="password" name="pswd" id="Passinputbox" placeholder="Password"> <br> <br>

                <label for="Passinputbox" class="lbl"> Confirm Password</label> <br>
                <input type="password" name="cnfrmpswd" id="cnfrmPassinputbox" placeholder="Password"> <br>

                <input id="check" type="checkbox" onclick="myFunction()">
                <label for="check" id="Showpassword">Show Password</label>

                <button name= "SignUpbtn" id = "btn" onsubmit = "ValidationFun()"> Create Account </button>

            </form>

        </div>

    </div>

    <script src="SignUp.js"></script>
</body>
</html>
