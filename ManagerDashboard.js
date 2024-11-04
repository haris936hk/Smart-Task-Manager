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
