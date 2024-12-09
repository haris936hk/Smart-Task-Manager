// Get all form elements
const form = document.getElementById('updateAccountForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.querySelector('input[placeholder="Search for names.."]');
const nameInput = document.querySelector('input[name="nm"]');
const emailInput = document.querySelector('input[name="Email"]');
const dropdownList = document.getElementById('dropdownList');
const deleteBtn = document.getElementById('btn');

// Function to disable/enable search input and button
function disableInputs(disabled) {
    // Disable/enable search input
    searchInput.disabled = disabled;
    
    // Disable/enable delete button
    deleteBtn.disabled = disabled;
}

// Initialize search and button as disabled
disableInputs(true);

// Enable search and button when a role is selected
roleInputs.forEach(radio => {
    radio.addEventListener('change', () => {
        disableInputs(false);
    });
});

// Form submission handler
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

    // Confirm before deletion
    if (confirm("Are you sure you want to delete this account?")) {
        alert("Account deleted successfully!");
        // Clear the form
        nameInput.value = '';
        emailInput.value = '';
        searchInput.value = '';
        return true;
    }
    
    return false;
});

// Note: The name and email inputs are already disabled in HTML
// They will likely be populated when a user is selected from search
// You can add search functionality here if needed