<?php
include("db_connection.php");

// Function to fetch users by role
function fetchUsers($role) {
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

    if ($_POST['action'] === 'update_account') {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Validate and sanitize inputs
        $full_name = filter_input(INPUT_POST, 'nm', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'cnic', FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit;
        }

        // Prepare SQL to update user
        $sql = "UPDATE Users SET email = ? WHERE full_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $full_name);

        try {
            $result = $stmt->execute();
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Update failed']);
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
    <title>Update Account</title>
</head>
<body>
    <div id="container">
        <img id="UpdateAccountimg" src="Logo.png" alt="Image not found!">

        <div id="UpdateAccount">
            <form id="updateAccountForm" method="POST" onsubmit="return false;"> 
                <div id="Role">
                    <p>Please Select Role First</p>
                    <input type="radio" class="RadioButton" name="role" value="Manager">
                    <label for="html" class="lbl">Manager</label>
                    <input type="radio" class="RadioButton" name="role" value="Employee">
                    <label for="css" class="lbl">Employee</label>
                </div>

                <div id="insidedive">
                    <label for="search" id="nmlbl"> Search User</label>
                    <input type="text" id="nminputbox" placeholder="Search for names..">
                    <ul id="dropdownList" class="dropdown-list"></ul> <br>

                    <label for="inputbox" id="nmlbl">Enter Full Name for Update</label>
                    <input type="text" name="nm" id="nameInputBox" placeholder="Name" pattern="[A-Za-z]+"
                        title="Only alphabets are allowed" required> <br><br>

                    <label for="inputbox" id="maillbl">Enter Email Address for Update</label>
                    <input type="email" name="cnic" id="mailinputbox" placeholder="abc@gmail.com"
                        title="Enter a valid email address" required> <br>

                    <button name="UpdateAccountbtn" id="btn" type="submit"> Update Account </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const roleRadios = document.querySelectorAll('.RadioButton');
        const searchInput = document.getElementById('nminputbox');
        const dropdownList = document.getElementById('dropdownList');
        const fullNameInput = document.getElementById('nameInputBox');
        const emailInput = document.getElementById('mailinputbox');
        const form = document.getElementById('updateAccountForm');

        let currentRole = ''; // Track selected role
        let users = []; // Store users fetched from the server

        // Add event listeners to role radio buttons
        roleRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                currentRole = this.value;
                searchInput.value = ''; // Clear search input
                dropdownList.innerHTML = ''; // Clear previous results
                fetchUsers(); // Fetch users based on selected role
            });
        });

        // Fetch users from server based on selected role
        function fetchUsers() {
            const formData = new FormData();
            formData.append('action', 'fetch_users');
            formData.append('role', currentRole);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                users = data;
                populateDropdown(users);
            })
            .catch(error => {
                console.error('Error fetching users:', error);
                alert('Failed to fetch users. Please try again.');
            });
        }

        // Populate dropdown with filtered users
        function populateDropdown(filteredUsers) {
            dropdownList.innerHTML = ''; // Clear previous results
            filteredUsers.forEach(user => {
                const li = document.createElement('li');
                li.textContent = user.full_name;
                li.addEventListener('click', () => {
                    searchInput.value = user.full_name;
                    fullNameInput.value = user.full_name;
                    emailInput.value = user.email;
                    dropdownList.innerHTML = ''; // Clear dropdown
                });
                dropdownList.appendChild(li);
            });
        }

        // Filter function for search input
        function filterFunction() {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredUsers = users.filter(user => 
                user.full_name.toLowerCase().includes(searchTerm)
            );
            populateDropdown(filteredUsers);
        }

        // Attach filter function to search input
        searchInput.addEventListener('keyup', filterFunction);

        // Form submission handler
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Check if role is selected
            if (!currentRole) {
                alert('Please select a role first.');
                return;
            }

            const formData = new FormData(this);
            formData.append('action', 'update_account');
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Account updated successfully!');
                    // Optional: reset form
                    this.reset();
                    currentRole = '';
                    dropdownList.innerHTML = '';
                } else {
                    alert(data.message || 'Update failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during update.');
            });
        });
    });
    </script>
</body>
</html>