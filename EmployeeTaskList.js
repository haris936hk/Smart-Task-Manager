
function redirectToDashboard()
{
    window.location.href = "EmployeeDashboard.php";
}

function redirectToTaskList()
{
    window.location.href = "EmployeeTaskList.php";
}


function showPopup() {
    // Fetch text from the database (dummy text for now)
    const dynamicText = "This is a sample note from the database."; 

    // Display the popup
    const popup = document.getElementById("popup");
    popup.style.display = "flex";

    // Set the dynamic text in the textbox
    document.getElementById("popup-text").value = dynamicText;
}

function closePopup() {
    // Hide the popup
    document.getElementById("popup").style.display = "none";
}

