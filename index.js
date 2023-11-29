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
});
function redirectToLogin() {
    window.location.href = 'login.html';
}

    