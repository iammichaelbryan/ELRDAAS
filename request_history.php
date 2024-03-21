<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - Make a Request</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
           
                 <!-- Main Content Section -->
    <main class="main-content">
        <h2>Resident Portal</h2>
        <h1>Request History</h1>
        <div class="request-history">
            <table class="requests-table">
            <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Type</th>
                        <th>Request Description</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                        <th>Assigned To</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php include 'db_connect.php';?>
                    </tbody>

            </table>
        </div>
    </main>

            <!--Right Section-->

<?php include 'res_right_section.php';?>
        <!--End of Right Section-->
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fetchUserComplaints = () => {
                    fetch('fetch_requests.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(complaints => {
                            if (complaints.error) {
                                console.error(complaints.error);
                            } else {
                                updateComplaintsTable(complaints);
                            }
                        })
                        .catch(error => console.error('Error fetching user complaints:', error));
                };
        
                const updateComplaintsTable = (complaints) => {
                    const tableBody = document.querySelector('.requests-table tbody');
                    tableBody.innerHTML = ''; // Clear the table body before appending new rows
        
                    complaints.forEach(complaint => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${complaint.complaint_id}</td>
                            <td>${complaint.complaint_type}</td>
                            <td>${complaint.complaint_body}</td>
                            <td>${complaint.status}</td>
                            <td>${complaint.date_submitted}</td>
                            <td>${complaint.assigned_to}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                };
        
                fetchUserComplaints();
            });
        </script>
        


</body>
</html>