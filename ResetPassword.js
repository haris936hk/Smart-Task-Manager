function ValidationFun(event) {
    var pass = document.getElementById("Passinputbox");
    var cnfpass = document.getElementById("cnfrmPassinputbox");

    pass.style.border = "";
    cnfpass.style.border = "";

    if (pass.value === "") {
        pass.style.border = "2px solid red";
        pass.focus(); // Set focus to the first empty field
        pass.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    } else if (cnfpass.value === "") {
        cnfpass.style.border = "2px solid red";
        cnfpass.focus(); // Set focus to the first empty field
        cnfpass.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    }
    // If everything is filled, allow the form to submit
    return true; // Allow form submission
}

function myFunction() {
    var x = document.getElementById("Passinputbox");
    var y = document.getElementById("cnfrmPassinputbox");


    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }

    if (x.value !== "" && y.value === "") {
        x.focus();
    } else if (y.value !== "" && x.value === "") {
        y.focus();
    } else if (x.value !== "" && y.value !== "") {
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

// Add an event listener to the "Show Alert" button
document.getElementById('btn')
    .addEventListener('click', function () {
        document.getElementById('alert')
            .style.display = 'block';
    })