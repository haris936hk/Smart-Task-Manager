let userList = [];

const form = document.getElementById('updateAccountForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.querySelector('input[placeholder="Search for user.."]');
const nameInput = document.querySelector('input[name="nm"]');
const emailInput = document.querySelector('input[name="Email"]');
const usernameInput = document.querySelector('input[name="Username"]'); // Username input
const dropdownList = document.getElementById('dropdownList');
const updateBtn = document.getElementById('btn');

function disableInputs(disabled) {
    searchInput.disabled = disabled;
    nameInput.disabled = disabled;
    emailInput.disabled = disabled;
    usernameInput.disabled = disabled;
    updateBtn.disabled = disabled;
}

disableInputs(true);

roleInputs.forEach(radio => {
    radio.addEventListener('change', () => {
        disableInputs(false);
        fetchUsersByRole(radio.value);
    });
});

function fetchUsersByRole(role) {
    dropdownList.innerHTML = '';

    fetch('UpdateAccount.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'fetch_users',
            role: role
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            userList = data;
            searchInput.addEventListener('input', handleSearch);
        }
    })
    .catch(error => console.error('Error:', error));
}

function handleSearch() {
    const searchTerm = searchInput.value.toLowerCase();

    if (searchTerm.trim() === '') {
        dropdownList.innerHTML = '';
    } else {
        const filteredUsers = userList.filter(user =>
            user.full_name.toLowerCase().includes(searchTerm)
        );

        if (filteredUsers.length > 0) {
            populateDropdown(filteredUsers.slice(0, 2));
        } else {
            dropdownList.innerHTML = '<li>No results found</li>';
        }
    }
}

function populateDropdown(users) {
    dropdownList.innerHTML = '';

    users.forEach(user => {
        const li = document.createElement('li');
        li.textContent = `${user.full_name} (${user.email})`;
        li.classList.add('dropdown-item');
        li.addEventListener('click', () => {
            const originalNameInput = document.createElement('input');
            originalNameInput.type = 'hidden';
            originalNameInput.name = 'original_nm';
            originalNameInput.value = user.full_name;

            nameInput.value = user.full_name;
            emailInput.value = user.email;
            usernameInput.value = user.username; // Set username value
            dropdownList.innerHTML = '';

            const existingOriginalInput = form.querySelector('input[name="original_nm"]');
            if (existingOriginalInput) {
                existingOriginalInput.remove();
            }

            form.appendChild(originalNameInput);
        });
        dropdownList.appendChild(li);
    });
}

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const originalName = form.querySelector('input[name="original_nm"]').value;

    fetch('UpdateAccount.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'update_account',
            original_nm: originalName,
            nm: nameInput.value,
            Email: emailInput.value,
            Username: usernameInput.value // Include username
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Account updated successfully!");
            location.reload(); // Refresh the page after alert
        } else {
            alert(`Update failed: ${data.message}`);
        }
    })
    .catch(error => console.error('Error:', error));
});
