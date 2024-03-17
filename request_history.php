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
                        <th>Type of Request</th>
                        <th>Description</th>
                        <th>Resolution Status</th>
                        <th>Date Submitted</th>
                        <th>Assigned To</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamically load completed requests here -->
                   
                    <!-- Repeat for other requests -->
                </tbody>
            </table>
        </div>
    </main>

            <!--Right Section-->

<div class="right-section">
    <div class="nav">
        <button id ="menu-btn">
            <span class="material-icons-sharp">
                menu
            </span>
        </button>
        <div class="dark-mode">
            <span class="material-icons-sharp active">
                light_mode
            </span>
            <span class="material-icons-sharp">
                dark_mode
            </span>
        </div>
        <div class="profile">
            <a href="profile.html" class="profile-link">
                <div class="profil-photo">
                    <img src="images/elf wolf 1.jpeg" alt="Profile Picture">
                </div>
            </a>
            <div class="info">
                <p>Hey, <b>[Resident Name]</b></p>
                <small class="text-muted">Resident</small>
            </div>
        </div>
        </div>
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