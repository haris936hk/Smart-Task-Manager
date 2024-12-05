<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SignUp.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="container">
        <img id="SignUpimg" src="Logo.png" alt="Image not found!">

        <div id="SignUp">

            <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>

                <div id="Role">
                <p class="lbl">Select Role First: </p> <br>
                    <input type="radio" class="RadioButton" name="fav_language" value="CSS">
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="fav_language" value="CSS">
                    <label for="css" class="lbl">Employee</label>
                </div>

                <label for="inputbox" class="lbl"> Username </label> <br>
                <input type="text" name="id" id="inputbox" placeholder="Username" required> <br><br>

                <label for="inputbox" class="lbl">Enter Full Name </label> <br>
                <input type="text" name="nm" id="nminputbox" placeholder="Name" pattern="[A-Za-z]+"
                    title="Only alphabets are allowed" required> <br><br>

                <label for="inputbox" class="lbl">Enter Email Address </label> <br>
                <input type="email" name="email" id="mailinputbox" placeholder="abc@gmail.com"
                    title="Enter a valid email address" required> <br><br>

                <label for="Passinputbox" class="lbl">Enter Password</label> <br>
                <input type="password" id="Passinputbox" name="pswd" placeholder="Password" required> <br> <br>

                <label for="Passinputbox" class="lbl"> Confirm Password</label> <br>
                <input type="password" name="cnfrmpswd" id="cnfrmPassinputbox" placeholder="Confirm Password" required
                    oninput="validatePassword()"> <br>

                <input id="check" type="checkbox" onclick="myFunction()">
                <label for="check" id="Showpassword">Show Password</label>

                <button name="SignUpbtn" id="btn" type="submit"> Create Account </button>
            </form>
        </div>
    </div>

    <script src="SignUp.js"></script>
</body>

</html>