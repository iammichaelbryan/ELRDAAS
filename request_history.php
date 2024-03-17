<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>ELR Towers Hall Domestic Affairs - Make a Request</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <aside>
                <div class="toggle">
                    <div class="logo">
                        <img src="images/elr towers logo.png" alt="logo">
                        <h2>ELR Towers Hall<span class = "danger"> Domestic Affairs</span></h2>
                        <div class="close" id="close-btn">
                            <span class="material-icons-sharp">
                                close
                            </span>
                            
                        </div>
    
                    </div>
    
                    <div class="sidebar" class="active">
                        <div>
                            <a href = "resident_dashboard.html"  >
                            <span class="material-icons-sharp">
                                info
                            </span>
                            <h3>View General Notice Board</h3>
                        </a>
                        <a href = "make_requests.html">
                        
                            <span class="material-icons-sharp" >
                                receipt_long
                            </span>
                            <h3>Make Request/Complaint</h3>
                            </a>
                            <a href = "notifications_res.html" >
                                <span class="material-icons-sharp">
                                    notifications
                                </span>
                                <h3>Notifications</h3>
                                </a>
                        <a href = "schedule_appointment.html">
                                <span class="material-icons-sharp">
                                    event
                                </span>
                                <h3>Schedule Laundromat</h3>
                                </a>
                        <a href = "pending_requests.html" >
                            <span class="material-icons-sharp">
                                hourglass_bottom
                            </span>
                            <h3>View Pending Requests</h3>
                            </a>
                        <a href = "request_history.php" class="active">
                            <span class="material-icons-sharp">
                                receipt_long
                                </span>
                                <h3>Request History</h3>
                                </a>

                        <a href = "profile.html" >
                            <span class="material-icons-sharp">
                                person_outline
                            </span>
                            <h3>Profile</h3>
                            </a>
                        <a href = "settings.html">
                            <span class="material-icons-sharp">
                                settings
                            </span>
                            <h3>Settings</h3>
                            </a>
                        <a href = "login.html" target="_blank">
                            <span class="material-icons-sharp">
                                login
                            </span>
                            <h3>New Login</h3>
                            </a>
                        </div>
                        <a href = "logout_res.html">
                            <span class="material-icons-sharp">
                                logout
                            </span>
                            <h3>Logout</h3>
                            </a>
                    </div>
                
                </div>
            </aside>
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
        const darkModeToggle = document.querySelector('.dark-mode');
        const bodyElement = document.body;
    
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
    
        
        loadModePreference();
        updateModeIndicator();
        fetchUserComplaints();
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
        
                
            });
        </script>
        


</body>
</html>