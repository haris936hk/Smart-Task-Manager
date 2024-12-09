// Get all form elements
const form = document.getElementById('updateAccountForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.querySelector('input[placeholder="Search for names.."]');
const nameInput = document.querySelector('input[name="nm"]');
const emailInput = document.querySelector('input[name="Email"]');
const dropdownList = document.getElementById('dropdownList');
const updateBtn = document.getElementById('btn');

// Function to disable/enable all input fields
function disableInputs(disabled) {
    // Disable/enable search input
    searchInput.disabled = disabled;
    
    // Disable/enable name input
    nameInput.disabled = disabled;
    
    // Disable/enable email input
    emailInput.disabled = disabled;
    
    // Disable/enable update button
    updateBtn.disabled = disabled;
}

// Initialize all inputs as disabled
disableInputs(true);

// Enable inputs when a role is selected
roleInputs.forEach(radio => {
    radio.addEventListener('change', () => {
        disableInputs(false);
    });
});

// Form validation
form.addEventListener('submit', (event) => {
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
    
    // If everything is valid, you can proceed with form submission
    alert("Account update successful!");
    return true;
});