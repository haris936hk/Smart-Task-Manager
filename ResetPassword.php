<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ResetPassword.css">
    <title>Reset Password</title>
</head>

<body>

    <title>Reset Password</title>
    <div id="container">
        <img id="ResetPassImg" src="Logo.png" alt="Image not found!">

        <div id="UpdateAccount">
            <form id="updateAccountForm" method="POST" onsubmit="return false;">
                <div id="Role">
                    <p>Select Role First:</p>
                    <input type="radio" class="RadioButton" name="role" value="Manager">
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="role" value="Employee">
                    <label for="css" class="lbl">Employee</label>
                </div>

                <div id="insidedive">

                    <label for="search" id="searchlbl"> Search User</label>
                    <input type="text" class="inputbox" placeholder="Search for user..">
                    <ul id="dropdownList" class="dropdown-list"></ul>

                    <label for="inputbox" id="pswd">Enter New Password</label>
                    <input type="password" name="Name" class="inputbox" placeholder="Password" title="Enter Password"
                        required> <br>

                    <label for="inputbox" id="cnfpswd">Confirm New Password</label>
                    <input type="password" name="Email" class="inputbox" placeholder="Confirm Password"
                        title="Confirm Password" required> <br>

                    <input id="check" type="checkbox" onclick="myFunction()">
                    <label for="check" id="Showpassword">Show Password</label>

                    <button name="UpdateAccountbtn" id="btn" type="submit" onclick="ValidationFun(event) "> Reset
                        Password</button>
                </div>
            </form>
        </div>
    </div>

    <script src="ResetPassword.js"></script>
</body>

</html>