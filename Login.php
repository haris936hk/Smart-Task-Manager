<?php
session_start();

// If the user is already logged in, redirect them to the appropriate dashboard
if (isset($_SESSION['user_id'])) {
    // Redirect based on the user's role
    if ($_SESSION['role'] === 'Admin') {
        header("Location: AdminDashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'Manager') {
        header("Location: ManagerDashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'Employee') {
        header("Location: EmployeeDashboard.php");
        exit();
    }
}

// Include the database connection
include('db_connection.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the user and check if the account is active
    $sql = "SELECT * FROM Users WHERE username = ? AND is_active = TRUE";  // Added is_active check
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'Admin') {
                header("Location: AdminDashboard.php");
            } elseif ($user['role'] === 'Manager') {
                header("Location: ManagerDashboard.php");
            } elseif ($user['role'] === 'Employee') {
                header("Location: EmployeeDashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No active user found with the given username.";
    }
}
?>

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
        <img id="img" src="Logo.png" alt="Image not found!">

        <form action="login.php" method="POST" onsubmit="return ValidationFun(event)"> <br>
            <label for="inputbox" class="lbl">Enter User Name</label> <br>
            <input type="text" name="username" id="inputbox" placeholder="Username" required> <br><br>
            <label for="Passinputbox" class="lbl">Enter Password</label> <br>
            <input type="password" name="password" id="Passinputbox" placeholder="Password" required> <br>
            <input id="check" type="checkbox" onclick="myFunction()">
            <label for="check" id="Showpassword">Show Password</label>

            <button name="btn" id="btn" type="submit">Login</button>
        </form>
    </div>

    <script src="Login.js"></script>
</body>
</html>
