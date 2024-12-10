// Get all form elements
const form = document.getElementById('resetPasswordForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.getElementById('search');
const passwordInput = document.querySelector('input[name="password"]');
const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
const showPasswordCheckbox = document.getElementById('check');
const dropdownList = document.getElementById('dropdownList');
const usernameDisplay = document.getElementById('usernameDisplay'); // Username display above password

// Disable all input fields initially
function disableInputs(disabled) {
    searchInput.disabled = disabled;
    passwordInput.disabled = disabled;
    confirmPasswordInput.disabled = disabled;
    showPasswordCheckbox.disabled = disabled;
}

// Initialize all inputs as disabled
disableInputs(true);

// Add event listeners to role radio buttons
roleInputs.forEach(radio => {
    radio.addEventListener('change', () => {
        // Enable all inputs when a role is selected
        disableInputs(false);
    });
});

// Show/Hide password functionality
function myFunction() {
    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
        confirmPasswordInput.type = "text";
    } else {
        passwordInput.type = "password";
        confirmPasswordInput.type = "password";
    }
}

// Search users based on role and query
function searchUsers() {
    const role = document.querySelector('input[name="role"]:checked')?.value;
    const query = searchInput.value.trim();

    if (!role || query.length === 0) {
        dropdownList.innerHTML = ''; // Clear the dropdown list if no role is selected or no input
        return;
    }

    fetch(`ResetPassword.php?role=${role}&query=${query}`)
        .then(response => response.json())
        .then(data => {
            dropdownList.innerHTML = '';
            if (data.length > 0) {
                data.forEach(user => {
                    const listItem = document.createElement('li');
                    listItem.textContent = user.username;
                    listItem.onclick = () => selectUser(user.username);
                    dropdownList.appendChild(listItem);
                });
            } else {
                dropdownList.innerHTML = '<li>No users found</li>';
            }
        })
        .catch(error => console.error('Error fetching user data:', error));
}

// Select a user from the dropdown
function selectUser(username) {
    searchInput.value = username;
    dropdownList.innerHTML = ''; // Clear the dropdown after selection
    usernameDisplay.value = username; // Show username above password input
}

// Password validation function
function ValidationFun(event) {
    event.preventDefault(); // Prevent form submission

    // Check if a role is selected
    let roleSelected = false;
    roleInputs.forEach(radio => {
        if (radio.checked) roleSelected = true;
    });

    if (!roleSelected) {
        alert("Please select a role first");
        return false;
    }

    // Get password values
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    // Check if passwords match
    if (password !== confirmPassword) {
        confirmPasswordInput.setCustomValidity("Passwords must match!");
        confirmPasswordInput.reportValidity();
        return false;
    }

    // Clear any previous validation messages if passwords match
    confirmPasswordInput.setCustomValidity("");

    console.log("Validation passed, submitting form."); // Debugging log
    form.submit();  // Programmatically submit the form if validation passes
    return true;
}

// Add event listener for password input to clear validation message when typing
confirmPasswordInput.addEventListener('input', () => {
    confirmPasswordInput.setCustomValidity("");
});
