<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DeleteAccount.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="container">
    <img id="SignUpimg" src="Logo.png" alt="Image not found!">
    
        <div id="SignUp">
            
            <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>

                <label for="inputbox" class="lbl"> Username </label> <br>
                <input type="text" name="id" id="inputbox" placeholder="Username" disabled> <br><br>

                <label for="inputbox" class="lbl">Full Name </label> <br>
                <input type="text" name="nm" id="nminputbox" placeholder="Name" pattern="[A-Za-z]+"
                    title="Only alphabets are allowed" disabled> <br><br>

                <label for="inputbox" class="lbl">Email Address </label> <br>
                <input type="email" name="cnic" id="mailinputbox" placeholder="abc@gmail.com"
                    title="Enter a valid email address" disabled> <br><br>

                <button name="DeleteButton" id="btn" type="submit" onclick="MyFunction(event)"> Delete Account </button>
            </form>
        </div>
    </div>

    <div id="alert">
        <div id ="popup">
            <p>Do You Want to Delete Account?</p>
            <button class = "DeleteButton">Yes</button>
            <button class = "DeleteButton">No</button>
        </div>
    </div>

    <script src="DeleteAccount.js"></script>
</body>

</html>