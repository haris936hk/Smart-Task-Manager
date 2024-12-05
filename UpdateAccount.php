<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UpdateAccount.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="container">
        <img id="UpdateAccountimg" src="Logo.png" alt="Image not found!">

        <div id="UpdateAccount">

            <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>

                <div id="Role">
                    <p>Please Select Role First</p>
                    <input type="radio" class="RadioButton" name="fav_language" value="CSS">
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="fav_language" value="CSS">
                    <label for="css" class="lbl">Employee</label>
                </div>

                <div id="insidedive">
                    <label for="search" id="nmlbl"> Search User</label>
                    <input type="text" id="nminputbox" onkeyup="filterFunction()" placeholder="Search for names..">
                    <ul id="dropdownList" class="dropdown-list">

                    </ul> <br>

                    <label for="inputbox" id="nmlbl">Enter Full Name for Update</label>
                    <input type="text" name="nm" id="nminputbox" placeholder="Name" pattern="[A-Za-z]+"
                        title="Only alphabets are allowed" required> <br><br>

                    <label for="inputbox" id="maillbl">Enter Email Address for Update</label>
                    <input type="email" name="cnic" id="mailinputbox" placeholder="abc@gmail.com"
                        title="Enter a valid email address" required> <br>

                    <button name="UpdateAccountbtn" id="btn" type="submit"> Update Account </button>
                </div>

            </form>
        </div>
    </div>

    <script src="UpdateAccount.js"></script>
</body>

</html>