let userList = [];

const form = document.getElementById('updateAccountForm');
const roleInputs = document.getElementsByName('role');
const searchInput = document.querySelector('input[placeholder="Search for user.."]');
const nameInput = document.querySelector('input[name="nm"]');
const emailInput = document.querySelector('input[name="Email"]');
const dropdownList = document.getElementById('dropdownList');
const deleteBtn = document.getElementById('btn');

function disableInputs(disabled) {
    searchInput.disabled = disabled;
    deleteBtn.disabled = disabled;
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

    fetch('DeleteAccount.php', {
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
            populateDropdown(filteredUsers.slice(0, 5));  // Show up to 5 results
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
            nameInput.value = user.full_name;
            emailInput.value = user.email;
            dropdownList.innerHTML = '';
        });
        dropdownList.appendChild(li);
    });
}

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const fullName = nameInput.value;
    const email = emailInput.value;

    if (!fullName || !email) {
        alert("Please select a user to delete");
        return;
    }

    // Confirm before deletion
    if (confirm("Are you sure you want to delete this account?")) {
        deleteAccount(fullName, email);
    }
});

function deleteAccount(fullName, email) {
    fetch('DeleteAccount.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'delete_account',
            nm: fullName,
            cnic: email  // CNIC is the email in your current setup
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Account deleted successfully!");
            location.reload(); // Refresh the page after deletion
        } else {
            alert(`Delete failed: ${data.message}`);
        }
    })
    .catch(error => console.error('Error:', error));
}
