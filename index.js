// Description: This file contains the JavaScript code for the index.html page.


Requests.forEach(request => {
    const row = document.createElement('tr');
    const requestContent = `
        <td>${request.residentName}</td>
        <td>${request.activityType}</td>
        <td>${request.activityID}</td>
        <td>${request.activityDate}</td>
        <td>${request.activityTime}</td>
        <td class="${request.status === 'Pending' || request.status === 'Pending Assignment' ? 'danger' : request.status === 'Confirmed' || request.status === 'Request Resolved' ? 'success' : request.status === 'Request Assigned' ? 'warning' : ''}">${request.status}</td>
        <td class="tertiary">Details</td>
    `;

    row.innerHTML = requestContent;
    document.querySelector('table tbody').appendChild(row);
});

document.getElementById('add-admin-button').addEventListener('click', function() {
    // Code to add new Admin goes here
    
});// Add event listener for DOMContentLoaded to ensure all elements are loaded
document.addEventListener('DOMContentLoaded', function() {
    // Dark Mode Toggle
    const darkModeToggle = document.querySelector('.dark-mode');
    const bodyElement = document.body;

    // Load and apply the mode preference on initial load
    loadModePreference();
    updateModeIndicator();

    darkModeToggle.addEventListener('click', () => {
        bodyElement.classList.toggle('dark-mode-variables');
        saveModePreference();
        updateModeIndicator();
    });

    function saveModePreference() {
        const isDarkMode = bodyElement.classList.contains('dark-mode-variables');
        localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
    }

    function loadModePreference() {
        const darkMode = localStorage.getItem('darkMode');
        if (darkMode === 'enabled') {
            bodyElement.classList.add('dark-mode-variables');
        } else {
            bodyElement.classList.remove('dark-mode-variables');
        }
    }

    function updateModeIndicator() {
        const isDarkMode = bodyElement.classList.contains('dark-mode-variables');
        const lightIcon = document.querySelector('.dark-mode .light_mode');
        const darkIcon = document.querySelector('.dark-mode .dark_mode');

        if (isDarkMode) {
            lightIcon.classList.add('active');
            darkIcon.classList.remove('active');
        } else {
            lightIcon.classList.remove('active');
            darkIcon.classList.add('active');
        }
    }

   
    window.openMessageModal = function(requestId) {
        alert("Modal function called for request ID: " + requestId);
        document.getElementById('messageModal').style.display = 'block';
    };

    // Function to close the modal
    function closeModal() {
        document.getElementById('messageModal').style.display = 'none';
    }

    // Function to handle the message sending
    function sendMessage() {
        var message = document.getElementById('messageText').value;
        console.log("Message:", message); // For demonstration
        closeModal(); // Close the modal after sending the message
    }

    // Attach sendMessage to the send button inside the modal
    document.getElementById('sendButton').addEventListener('click', sendMessage);
});