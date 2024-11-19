<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ResetPassword.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="container">
        <img id="Resetimg" src="Logo.png" alt="Image not found!">

        <div id="ResetPassword">

            <form action="" method="POST" onsubmit="return ValidationFun(event) "> <br>

                <label for="inputbox" id="searchlbl"> Search User </label> <br>
                <div class="search-container">
                    <form class="search-container" action="/search" method="get">
                        <input type="text" placeholder="Search">
                        <button type="submit" class="search-icon-btn"><img class="search_icon" src="Search_icon.svg"
                                alt="Icon not fount!"></button>
                    </form>
                </div> <br>

                <label for="Passinputbox" id="paslbl">Enter Password</label>
                <input type="password" id="Passinputbox" name="pswd" placeholder="Password" required> <br>

                <label for="Passinputbox" id="cpaslbl"> Confirm Password</label>
                <input type="password" name="cnfrmpswd" id="cnfrmPassinputbox" placeholder="Confirm Password" required
                    oninput="validatePassword()"> <br>

                <input id="check" type="checkbox" onclick="myFunction()">
                <label for="check" id="Showpassword">Show Password</label>

                <button name="UpdateAccountbtn" id="btn" type="submit" onclick="ValidationFun(event) "> Reset Password
                </button>
            </form>
        </div>
    </div>

    <div id="alert">
        <p>Your Password is Resest.</p>
        <button onclick="document.getElementById('alert').style.display = 'none'"> Ok </button>
    </div>

    <script src="ResetPassword.js"></script>
</body>

</html>