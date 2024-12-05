function togglePopup(title)
{
    const popup = document.getElementById('popup');
    const popupTitle = document.getElementById('popup-title');
    if (title) 
    {
        popupTitle.textContent = title;
        popup.style.display = 'block';
    } else 
    {
        popup.style.display = 'none';
    }
}

function redirectToDashboard() {
    window.location.href = "ManagerDashboard.php";
  }
  
  function redirectToTaskList() {
    window.location.href = "ManagerTaskList.php";
  }
  
  function redirectToTaskList() {
    window.location.href = "CreateTask.php";
  }

  function redirectToLogin() {
    window.location.href='Login.php';
  }