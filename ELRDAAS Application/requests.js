function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
}

// Function to update tables with pending requests
function updateTables() {
    fetch('getPendingRequests.php')
        .then(response => response.json())
        .then(data => {
            // Check if data is not empty
            if (data.length > 0) {
                const tableContent = data.map(request => 
                    `<tr>
                        <td>${request.complaint_id}</td>
                        <td>${formatDate(request.date_submitted)}</td>
                        <td>${request.issueType}</td>
                        <td>${request.description}</td>
                        <td>${request.status}</td>
                    </tr>`
                ).join('');
                document.getElementById('pendingRequestsTable').innerHTML = tableContent;
            } else {
                // Handle empty data
                document.getElementById('pendingRequestsTable').innerHTML = '<tr><td colspan="5">No pending requests</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Optionally update the table to show an error message
            document.getElementById('pendingRequestsTable').innerHTML = '<tr><td colspan="5">Error loading requests</td></tr>';
        });
}

// Call updateTables on page load
document.addEventListener('DOMContentLoaded', updateTables);

// Update the table every 3 seconds
setInterval(updateTables, 3000);
