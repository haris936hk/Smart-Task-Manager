<?php
include("db_connection.php");

function fetchUsers($role) {
    global $conn;

    if ($conn->connect_error) {
        return ['error' => 'Connection failed: ' . $conn->connect_error];
    }

    $sql = "SELECT full_name, email, username FROM Users WHERE role = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return ['error' => 'Prepare statement failed: ' . $conn->error];
    }

    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    return $users;
}

function updateUserAccount($original_name, $new_name, $new_email, $new_username) {
    global $conn;

    if ($conn->connect_error) {
        return ['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error];
    }

    // Validate inputs
    $new_name = trim($new_name);
    $new_email = filter_var($new_email, FILTER_VALIDATE_EMAIL);
    $new_username = trim($new_username);

    if (empty($new_name) || empty($new_username)) {
        return ['success' => false, 'message' => 'Full name and username cannot be empty'];
    }

    if (!$new_email) {
        return ['success' => false, 'message' => 'Invalid email format'];
    }

    // Check if the user with the original name exists
    $checkUserSql = "SELECT full_name, email FROM Users WHERE full_name = ?";
    $checkUserStmt = $conn->prepare($checkUserSql);
    $checkUserStmt->bind_param("s", $original_name);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows === 0) {
        return ['success' => false, 'message' => 'No matching user found'];
    }

    // Check for existing email for other users
    $checkEmailSql = "SELECT COUNT(*) AS email_count FROM Users WHERE email = ? AND full_name != ?";
    $checkStmt = $conn->prepare($checkEmailSql);
    $checkStmt->bind_param("ss", $new_email, $original_name);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $emailCheck = $checkResult->fetch_assoc();

    // Check for existing username for other users
    $checkUsernameSql = "SELECT COUNT(*) AS username_count FROM Users WHERE username = ? AND full_name != ?";
    $checkUsernameStmt = $conn->prepare($checkUsernameSql);
    $checkUsernameStmt->bind_param("ss", $new_username, $original_name);
    $checkUsernameStmt->execute();
    $checkUsernameResult = $checkUsernameStmt->get_result();
    $usernameCheck = $checkUsernameResult->fetch_assoc();

    // Close the statements after fetching results
    $checkStmt->close();
    $checkUsernameStmt->close();

    if ($emailCheck['email_count'] > 0) {
        return ['success' => false, 'message' => 'Email already in use by another user'];
    }

    if ($usernameCheck['username_count'] > 0) {
        return ['success' => false, 'message' => 'Username already in use by another user'];
    }

    // Prepare SQL to update user
    $sql = "UPDATE Users SET full_name = ?, email = ?, username = ? WHERE full_name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return ['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error];
    }

    $stmt->bind_param("ssss", $new_name, $new_email, $new_username, $original_name);

    try {
        $result = $stmt->execute();

        if ($result) {
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return ['success' => true, 'message' => 'Account updated successfully'];
            } else {
                $stmt->close();
                return ['success' => false, 'message' => 'No changes made or user not found'];
            }
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'Update failed: ' . $stmt->error];
        }
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] === 'fetch_users') {
        $role = $_POST['role'] ?? '';
        if (!empty($role)) {
            $users = fetchUsers($role);
            echo json_encode($users);
        } else {
            echo json_encode(['error' => 'Role not provided']);
        }
        exit;
    }

    if ($_POST['action'] === 'update_account') {
        $original_name = $_POST['original_nm'];
        $new_name = $_POST['nm'];
        $new_email = $_POST['Email'];
        $new_username = $_POST['Username'];

        $result = updateUserAccount($original_name, $new_name, $new_email, $new_username);
        echo json_encode($result);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UpdateAccount.css">
    <title>Update Account</title>
</head>
<body>
    <div id="container">
        <img id="UpdateAccountimg" src="Logo.png" alt="Image not found!">

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
                    <label for="search" id="searchlbl">Search User</label>
                    <input type="text" class="inputbox" placeholder="Search for user.." autocomplete="off" id="searchInput">
                    <ul id="dropdownList" class="dropdown-list"></ul>

                    <label for="inputbox" id="Usernamelbl">Enter Username for Update</label>
                    <input type="text" name="Username" class="inputbox" placeholder="Username" required> <br>

                    <label for="inputbox" id="namelbl">Enter Full Name for Update</label>
                    <input type="text" name="nm" class="inputbox" placeholder="Name" pattern="[A-Za-z\s]+" 
                           title="Only alphabets and spaces are allowed" required> <br>

                    <label for="inputbox" id="Emaillbl">Enter Email Address for Update</label>
                    <input type="email" name="Email" class="inputbox" placeholder="abc@gmail.com"
                           title="Enter a valid email address" required> <br>

                    <input type="submit" value="Update" id="btn" class="btn">
                </div>
            </form>
        </div>
    </div>

    <script src="UpdateAccount.js"></script>
</body>
</html>
