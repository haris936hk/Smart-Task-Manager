<?php
include('db_connection.php');

// Handle search query
if (isset($_GET['role']) && isset($_GET['query'])) {
    $role = $_GET['role'];
    $query = $_GET['query'];

    // Sanitize inputs
    $role = $conn->real_escape_string($role);
    $query = $conn->real_escape_string($query);

    // Query to search users by role and username
    $sql = "SELECT username FROM Users WHERE role = ? AND username LIKE ? AND is_active = TRUE";
    $stmt = $conn->prepare($sql);
    $searchQuery = "%$query%";
    $stmt->bind_param("ss", $role, $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and return matching users as JSON
    $users = [];
    while ($user = $result->fetch_assoc()) {
        $users[] = $user;
    }
    echo json_encode($users);
    exit();
}

// Handle password reset
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the form inputs
    $role = $_POST['role'];
    $username = $_POST['search']; // Username selected from the search
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the new password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE Users SET password_hash = ? WHERE username = ? AND role = ? AND is_active = TRUE";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $password_hash, $username, $role);

    if ($stmt->execute()) {
        echo "Password reset successfully!";
    } else {
        echo "Error resetting password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ResetPassword.css">
    <title>Reset Password</title>
</head>

<body>
    <div id="container">
        <img id="ResetPassImg" src="Logo.png" alt="Image not found!">

        <div id="UpdateAccount">
            <form id="resetPasswordForm" method="POST" action="ResetPassword.php" onsubmit="return ValidationFun(event)">
                <div id="Role">
                    <p>Select Role First:</p>
                    <input type="radio" class="RadioButton" name="role" value="Manager">
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="role" value="Employee">
                    <label for="css" class="lbl">Employee</label>
                </div>

                <div id="insidedive">
                    <label for="search" id="searchlbl">Search User</label>
                    <input type="text" class="inputbox" placeholder="Search for user..." id="search" name="search" oninput="searchUsers()">
                    <ul id="dropdownList" class="dropdown-list"></ul>

                    <!-- Display selected username here (disabled input) -->
                    <label for="usernameDisplay" id="usernameDisplayLabel">Selected Username</label>
                    <input type="text" id="usernameDisplay" disabled placeholder="Selected Username" class="inputbox">

                    <label for="inputbox" id="pswd">Enter New Password</label>
                    <input type="password" name="password" class="inputbox" placeholder="Password" required> <br>

                    <label for="inputbox" id="cnfpswd">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="inputbox" placeholder="Confirm Password" required> <br>

                    <input id="check" type="checkbox" onclick="myFunction()">
                    <label for="check" id="Showpassword">Show Password</label>

                    <button name="resetPasswordBtn" id="btn" type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>

    <script src="ResetPassword.js"></script>
</body>

</html>
