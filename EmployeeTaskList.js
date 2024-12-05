
function redirectToDashboard()
{
    window.location.href = "EmployeeDashboard.php";
}

function redirectToTaskList()
{
    window.location.href = "EmployeeTaskList.php";
}


function togglePopup() {
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('overlay');
    const isHidden = popup.style.display === 'none' || !popup.style.display;
    popup.style.display = isHidden ? 'block' : 'none';
    overlay.style.display = isHidden ? 'block' : 'none';
}

