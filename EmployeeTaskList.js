function togglePopup(title) {
    const popup = document.getElementById('popup');
    const popupTitle = document.getElementById('popup-title');
    if (title) {
        popupTitle.textContent = title;
        popup.style.display = 'block';
    } else {
        popup.style.display = 'none';
    }
}