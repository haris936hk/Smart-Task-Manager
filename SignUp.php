<?php
// Include the database connection file
include("db_connection.php");

// Initialize variables
$username = $fullname = $email = $password = $confirmpassword = $role = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['id'];
    $fullname = $_POST['nm'];
    $email = $_POST['cnic'];
    $password = $_POST['pswd'];
    $confirmpassword = $_POST['cnfrmpswd'];
    $role = $_POST['fav_language'];

    // Validate password match
    if ($password === $confirmpassword) {
        // Hash the password for secure storage
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the user into the database
        $query = "INSERT INTO Users (username, full_name, email, password_hash, role, is_active) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $isActive = true; // Default value for is_active

        // Bind the parameters and execute the query
        $stmt->bind_param("sssssi", $username, $fullname, $email, $hashedPassword, $role, $isActive);

        // Execute the query and check if the insertion was successful
        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully!'); window.location.href='SignUp.php';</script>";
        } else {
            echo "<script>alert('Error creating account. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SignUp.css">
    <title>Create Account</title>
</head>

<body>

    <div id="container">
        <img id="SignUpimg" src="Logo.png" alt="Image not found!">

        <div id="SignUp">

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <br>

                <div id="Role">
                    <p class="lbl">Select Role First: </p> <br>
                    <input type="radio" class="RadioButton" name="fav_language" value="Manager" required>
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="fav_language" value="Employee" required>
                    <label for="css" class="lbl">Employee</label>
                    <input type="radio" class="RadioButton" name="fav_language" value="Admin" required>
                    <label for="admin" class="lbl">Admin</label>
                </div>

                <label for="inputbox" class="lbl">Username</label> <br>
                <input type="text" name="id" id="inputbox" placeholder="Username" required> <br><br>

                <label for="inputbox" class="lbl">Enter Full Name</label> <br>
                <input type="text" name="nm" id="nminputbox" placeholder="Full Name" pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" required> <br><br>

                <label for="inputbox" class="lbl">Enter Email Address</label> <br>
                <input type="email" name="cnic" id="mailinputbox" placeholder="abc@gmail.com" title="Enter a valid email address" required> <br><br>

                <label for="Passinputbox" class="lbl">Enter Password</label> <br>
                <input type="password" id="Passinputbox" name="pswd" placeholder="Password" required> <br><br>

                <label for="Passinputbox" class="lbl">Confirm Password</label> <br>
                <input type="password" name="cnfrmpswd" id="cnfrmPassinputbox" placeholder="Confirm Password" required oninput="validatePassword()"> <br>

                <input id="check" type="checkbox" onclick="myFunction()">
                <label for="check" id="Showpassword">Show Password</label>

                <button name="SignUpbtn" id="btn" type="submit">Create Account</button>
            </form>
        </div>
    </div>

    <script src="SignUp.js"></script>

</body>

</html>
