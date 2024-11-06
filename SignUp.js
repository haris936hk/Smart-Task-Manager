function showForm() 
{
    // Hide SelectRol smoothly
    document.getElementById('SelectRol').classList.add('hide');

    // Wait for the transition duration (2s) before hiding SelectRol and displaying container
    setTimeout(function() 
    {
        // Hide SelectRol completely after the fade-out
        document.getElementById('SelectRol').style.display = 'none';  

        // Show container after the transition (with smooth slide-in)
        const container = document.getElementById('container');
        container.classList.add('show');  // Slide-in container
    }, 1000);  // Match the transition duration (2s) of both elements
}

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

function ValidationFun(event) 
{
    // Get form elements
    var name = document.getElementById("nminputbox");
    var mail = document.getElementById("mailinputbox");
    var pass = document.getElementById("Passinputbox");
    var cnfpass = document.getElementById("cnfrmPassinputbox");

    // Reset borders in case they were previously set to red
    name.style.border = "";
    mail.style.border = "";
    pass.style.border = "";
    cnfpass.style.border = "";

    // Check for empty fields and set the border to red, focus on the first empty field
    if (name.value === "") 
    {
        name.style.border = "2px solid red";
        name.focus(); // Set focus to the first empty field
        name.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    } 
    else if (mail.value === "") 
    {
        mail.style.border = "2px solid red";
        mail.focus(); // Set focus to the first empty field
        mail.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    } else if (pass.value === "") 
    {
        pass.style.border = "2px solid red";
        pass.focus(); // Set focus to the first empty field
        pass.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    } else if (cnfpass.value === "") 
    {
        cnfpass.style.border = "2px solid red";
        cnfpass.focus(); // Set focus to the first empty field
        cnfpass.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
        event.preventDefault(); // Prevent form submission
        return false; // Prevent form submission
    }
    // If everything is filled, allow the form to submit
    return true; // Allow form submission
}


