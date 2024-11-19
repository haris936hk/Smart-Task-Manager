document.addEventListener('click', function(event) 
{
    if (event.target.classList.contains('DeleteButton')) 
    {
      event.stopPropagation(); // Prevent bubbling
      document.getElementById('alert').style.display = 'block';
      document.getElementById('popup').style.display = 'block';
    }
}, true); // Capture event at the root