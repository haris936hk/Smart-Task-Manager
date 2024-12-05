

function myFunction() 
{
    var x = document.getElementById("Passinputbox");
    var y = document.getElementById("cnfrmPassinputbox");


    if (x.type === "password") 
    {
        x.type = "text";
    } else 
    {
        x.type = "password";
    }

    if (y.type === "password") 
    {
        y.type = "text"; 
    } else 
    {
        y.type = "password";
    }

    if (x.value !== "" && y.value === "") 
    {
        x.focus();
    } else if (y.value !== "" && x.value === "") 
    {
        y.focus();
    } else if (x.value !== "" && y.value !== "") 
    {
        y.focus();
    }
}

function validatePassword() {
    var pass = document.getElementById("Passinputbox").value;
    var cnfpass = document.getElementById("cnfrmPassinputbox");

    if (cnfpass.value !== pass) {
        cnfpass.setCustomValidity("Passwords do not match"); // Show custom error
    } else {
        cnfpass.setCustomValidity(""); // Reset custom error
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all input fields except radio buttons
    const inputFields = document.querySelectorAll('input:not([type="radio"])');
    const usernameField = document.getElementById('inputbox');
    const roleInputs = document.querySelectorAll('input[type="radio"]');

    // Initially disable all input fields
    inputFields.forEach(input => {
        if (input.type !== 'radio') {
            input.disabled = true;
        }
    });

    // Function to handle role selection
    function handleRoleSelection() {
        // Enable all inputs except username
        inputFields.forEach(input => {
            if (input.id !== 'inputbox') {
                input.disabled = false;
            }
        });

        // Keep username field disabled
        usernameField.disabled = true;

        // Generate and set username based on selected role
        const selectedRole = document.querySelector('input[type="radio"]:checked').nextElementSibling.textContent;
        const timestamp = Date.now().toString().slice(-4);
        usernameField.value = `${selectedRole}${timestamp}`;
    }

    // Add change event listener to radio buttons
    roleInputs.forEach(radio => {
        radio.addEventListener('change', handleRoleSelection);
    });
});






