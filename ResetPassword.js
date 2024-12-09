// Get all form elements
const form = document.getElementById('updateAccountForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.querySelector('input[placeholder="Search for user.."]');
const passwordInput = document.querySelector('input[name="Name"]');
const confirmPasswordInput = document.querySelector('input[name="Email"]');
const showPasswordCheckbox = document.getElementById('check');

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

// Password validation function
function ValidationFun(event) {
    event.preventDefault();
    
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
    
    // If everything is valid, you can submit the form here
    // form.submit();  // Uncomment this line when ready to submit
    return true;
}

// Add event listener for password input to clear validation message when typing
confirmPasswordInput.addEventListener('input', () => {
    confirmPasswordInput.setCustomValidity("");
});