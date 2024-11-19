function myFunction() {
  var passwordInput = document.getElementById("Passinputbox");

  if (passwordInput.type === "password") {
      passwordInput.type = "text";
  } else {
      passwordInput.type = "password";
  }
}

function ValidationFun(event) {
  // Get form elements
  var name = document.getElementById("inputbox");
  var pass = document.getElementById("Passinputbox");

  // Reset borders in case they were previously set to red
  name.style.border = "";
  pass.style.border = "";

  // Check for empty fields and set the border to red, focus on the first empty field
  if (name.value === "") {
      name.style.border = "2px solid red";
      name.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
      name.focus(); 
      event.preventDefault();
      return false;
  } else if (pass.value === "") {
      pass.style.border = "2px solid red";
      pass.style.boxShadow = "0px 0px 2px 2px rgba(255, 0, 0, 0.4)";
      pass.focus();
      event.preventDefault();
      return false;
  }
  return true;
}

