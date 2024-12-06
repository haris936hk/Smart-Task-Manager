
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

function updateTaskStatus(taskId, isChecked) {
    // Send an AJAX request to update the task status in the database
    const status = isChecked ? 'Completed' : 'In Progress';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);  // Submit to the same file
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Optionally, you can handle the response here (e.g., show a success message)
            console.log('Task status updated');
        }
    };
    xhr.send('task_id=' + taskId + '&status=' + status);
}