function myFunction() {
    var x = document.getElementById("Passinputbox");
    if (x.type === "password") 
    {
      x.type = "text";
    } else 
    {
      x.type = "password";
    }
  }