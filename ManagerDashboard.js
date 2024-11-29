document.getElementById("plus_btn").onclick = function() {
    document.getElementById("popupForm").style.display = "block";
}

document.querySelector(".close-btn").onclick = function() {
    document.getElementById("popupForm").style.display = "none";
}

window.onclick = function(event) {
    if (event.target === document.getElementById("popupForm")) {
        document.getElementById("popupForm").style.display = "none";
    }
}

document.getElementById("submissionForm").onsubmit = function(event) {
    event.preventDefault();
    // Handle form submission logic here
    alert("Form submitted!");
    document.getElementById("popupForm").style.display = "none"; // Close the popup
}

// Get the modal elements
const modal = document.getElementById("taskModal");
const createTaskBtn = document.getElementById("plus_btn");
const closeBtn = document.getElementsByClassName("close")[0];
const taskForm = document.getElementById("taskForm");

// Open modal when Create Task button is clicked
createTaskBtn.onclick = function() {
    modal.style.display = "block";
}

// Close modal when X is clicked
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Handle form submission
taskForm.onsubmit = function(e) {
    e.preventDefault();
    
    // Get form values
    const formData = {
        title: document.getElementById("taskTitle").value,
        description: document.getElementById("taskDescription").value,
        assignee: document.getElementById("assignee").value,
        dueDate: document.getElementById("dueDate").value,
        priority: document.getElementById("priority").value
    };

    // Here you would typically send the data to your backend
    console.log("Task Created:", formData);
    
    // Update task stats (you'll need to implement the actual logic)
    const totalTasks = document.getElementById("total_box");
    const pendingTasks = document.getElementById("pending_box");
    if (totalTasks.value === "") totalTasks.value = 0;
    if (pendingTasks.value === "") pendingTasks.value = 0;
    
    totalTasks.value = parseInt(totalTasks.value) + 1;
    pendingTasks.value = parseInt(pendingTasks.value) + 1;

    // Close the modal and reset form
    modal.style.display = "none";
    taskForm.reset();
}


function redirectToDashboard()
{
    window.location.href = "ManagerDashboard.php";
}

function redirectToTaskList()
{
    window.location.href = "ManagerTaskList.php";
}

function redirectToTask()
{
    window.location.href = "CreateTask.php";
}
