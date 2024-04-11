<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - View Pending Complaints</title>
    <style>
        .view-message-btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .view-message-btn:hover {
            background-color: #45a049;
        }
        /* Modal Styling */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
    background-color: var(--white-color);
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.dark-mode-variables .modal-content {
    background-color: var(--dark-color);
    color: var(--white-color);
    border-color: var(--dark-color-variant);
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div class="container">
        <?php include 'res_sidebar.php';?>
        <main class="main-content">
            <h2>Resident Portal</h2>
            <h1>Pending Complaints</h1>
            <div class="pending-requests">
                <table class="requests-table">
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Complaint Type</th>
                            <th>Complaint Description</th>
                            <th>Status</th>
                            <th>Date Submitted</th>
                            <th>Assigned To</th>
                            <th>Action Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'db_connect.php'; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <?php include 'res_right_section.php'; ?>
    </div>

    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeMessageModal()">&times;</span>
            <h2 id="modalMessageTitle">Latest Message</h2>
            <p id="modalMessageContent"></p>
        </div>
    </div>


    <script>
        // Function to open the message modal
        function openMessageModal(complaintId, message) {
            document.getElementById('modalMessageTitle').innerText = 'Message for Complaint ' + complaintId;
            document.getElementById('messageModal').style.display = 'block';
            document.getElementById('modalMessageContent').innerText = message;
        }

        // Function to close the message modal
        function closeMessageModal() {
            document.getElementById('messageModal').style.display = 'none';
        }

        // Replace the document ready function with the one below
        document.addEventListener('DOMContentLoaded', function() {
            const fetchUserComplaints = () => {
                fetch('fetch_pending_requests.php')
                    .then(response => response.json())
                    .then(complaints => updateComplaintsTable(complaints))
                    .catch(error => console.error('Error fetching user complaints:', error));
            };

            const updateComplaintsTable = (complaints) => {
                const tableBody = document.querySelector('.requests-table tbody');
                tableBody.innerHTML = '';

                complaints.forEach(complaint => {
                    const row = document.createElement('tr');
                    const message = complaint.message ? complaint.message : 'No message'; // Add a fallback for no message
                    row.innerHTML = `
                        <td>${complaint.complaint_id}</td>
                        <td>${complaint.complaint_type}</td>
                        <td>${complaint.complaint_body}</td>
                        <td>${complaint.status}</td>
                        <td>${complaint.date_submitted}</td>
                        <td>${complaint.assigned_to}</td>
                        <td><button class="view-message-btn" onclick="openMessageModal('${complaint.complaint_id}', '${complaint.message}')">View Latest Message</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            };

            fetchUserComplaints();
        });
    </script>

</body>
</html>