<?php
include("db_connection.php");

function fetchUsers($role)
{
    global $servername, $username, $password, $dbname;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        return ['error' => 'Connection failed: ' . $conn->connect_error];
    }

    // Prepare SQL to fetch users by role
    $sql = "SELECT full_name, email FROM Users WHERE role = ? AND is_active = TRUE";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $users;
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] === 'fetch_users') {
        $role = $_POST['role'] ?? '';
        echo json_encode(fetchUsers($role));
        exit;
    }

    if ($_POST['action'] === 'delete_account') {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Validate and sanitize inputs
        $full_name = filter_input(INPUT_POST, 'nm', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'cnic', FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit;
        }

        // Prepare SQL to delete user (soft delete by setting is_active to FALSE)
        $sql = "UPDATE Users SET is_active = FALSE WHERE full_name = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $full_name, $email);

        try {
            $result = $stmt->execute();

            if ($result) {
                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No matching user found']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Delete failed']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

        $stmt->close();
        $conn->close();
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
    <title>Delete Account</title>
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

                    <label for="search" id="searchlbl"> Search User</label>
                    <input type="text" class="inputbox" placeholder="Search for user..">
                    <ul id="dropdownList" class="dropdown-list"></ul>

                    <label for="inputbox" id="namelbl">Full Name</label>
                    <input type="text" name="nm" class="inputbox" placeholder="Name" title="Name" disabled> <br>

                    <label for="inputbox" id="Emaillbl">Email Address</label>
                    <input type="email" name="Email" class="inputbox" placeholder="abc@gmail.com" title="Email address"
                        disabled> <br>

                    <button name="UpdateAccountbtn" id="btn" type="submit"> Delete Account </button>
                </div>
            </form>
        </div>
    </div>
    <script src="DeleteAccount.js"></script>
</body>

</html>