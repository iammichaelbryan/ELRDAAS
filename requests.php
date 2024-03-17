<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>ELR Towers Hall Domestic Affairs</title>
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
    
                    <div class="sidebar">
                        <div>
                        <a href = "index.html" >
                            <span class="material-icons-sharp">
                                dashboard
                            </span>
                            <h3>Dashboard</h3>
                        </a>
                        <a href = "requests.html" class ="active">
                            <span class="material-icons-sharp">
                                receipt_long
                            </span>
                            <h3>View Assigned Requests</h3>
                            </a>
                        <a href = "notifications.html">
                                <span class="material-icons-sharp">
                                    notifications
                                </span>
                                <h3>Notifications</h3>
                                </a>
                                
                        <a href = "notice.html">
                            <span class="material-icons-sharp">
                                announcement
                            </span>
                            <h3>Create Notice</h3>
                            </a>
                            <a href = "admingennotices.html">
                                <span class="material-icons-sharp">
                                    info
                                    </span>
                                    <h3>View General Notice Board</h3>
                                    </a>
                        <a href = "laundryappointments.html" >
                            <span class="material-icons-sharp">
                                event
                            </span>
                            <h3>View Laundry Appointments</h3>
                            </a>
                        <a href = "requestfeedback.html">
                            <span class="material-icons-sharp">
                                star
                            </span>
                            <h3>Get Feedback</h3>
                        </a>
                        <a href = "adminprofile.html">
                            <span class="material-icons-sharp">
                                person_outline
                            </span>
                            <h3>Profile</h3>
                            </a>
                        <a href = "adminsettings.html">
                            <span class="material-icons-sharp">
                                settings
                            </span>
                            <h3>Settings</h3>
                            </a>
                        <a href = "login.html">
                            <span class="material-icons-sharp">
                                login
                            </span>
                            <h3>New Login</h3>
                            </a>
                        </div>
                        <a href = "logout.html">
                            <span class="material-icons-sharp">
                                logout
                            </span>
                            <h3>Logout</h3>
                            </a>
                    </div>
                
                </div>
            </aside>
            <!--End of Sidebar Section-->
            <main class="main-content">
                <h1>Assigned Requests</h1>
                <table class="requests-table">

                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Resident Name</th>
                            <th>Resident ID</th>
                            <th>Tower</th>
                            <th>Request Type</th>
                            <th>Request Description</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Priority</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>

                    <tbody>

                       <?php 

                       $host = 'localhost';
                       $username = "root";
                       $password = "";
                       $dbname = 'elrdaas';
                       
                       //Connect to database
                       try {
                           $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
                           // Set the PDO error mode to exception
                           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       } catch(PDOException $e) {
                           echo "Connection failed: " . $e->getMessage();
                       }
                       
                       //retrieve requests from the database
                       $sql = "SELECT * FROM complaints";
                       $complaints = $conn->query($sql);
                       if(!$complaints){
                           echo "Error: " . $sql . "<br>" . $conn->error;
                       }

                       //    Display the requests in the table
                       while ($row = $complaints->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td>".$row["complaint_id"]."</td>
                            <td>". $row["first_name"],' ',$row["last_name"]."</td>
                            <td>".$row["tower"]."</td>
                            <td>".$row["resident_id"]."</td>
                            <td>".$row["complaint_type"]."</td>
                            <td>".$row["complaint_body"]."</td>
                            <td>".$row["date_submitted"]."</td>
                            <td>
                                <select class='status-select'>
                                    <option value='Pending'>Pending</option>
                                    <option value='In-progress'>In Progress</option>
                                    <option value='Completed'>Completed</option>
                                </select>
                            </td>
                            <td>".$row["assigned_to"]."</td>
                            <td>
                                <select class='priority-select'>
                                    <option value='low'>Low</option>
                                    <option value='medium'>Medium</option>
                                    <option value='high'>High</option>
                                </select>
                            </td>
                            <td>
                                <button class='message-btn' onclick='openMessageModal('001')'>Message</button>
                            </td>
                        </tr>";
                       }
                        ?>
                    </tbody>

                </table>
            </main>
            
            <!-- Modal Structure -->
            <div id="messageModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h2>Send Message</h2>
                    <textarea id="messageText" placeholder="Write your message here..."></textarea>
                    <button class="send-message-btn" onclick="sendMessage()">Send</button>
                </div>
            </div>
            <script>
                // Function to open the message modal
                window.openMessageModal = function(requestId) {
                    document.getElementById('messageModal').style.display = 'block';
                    console.log("Opening message modal for request ID:", requestId);
                    // You can use requestId to customize the modal for each request
                };
            
                // Function to close the modal
                function closeModal() {
                    document.getElementById('messageModal').style.display = 'none';
                }
            
                // Function to handle the message sending
                function sendMessage() {
                    var message = document.getElementById('messageText').value;
                    // Add the logic to handle the message (e.g., send to server)
                    console.log("Message:", message); // For demonstration
                    closeModal(); // Close the modal after sending the message
                }
            
                // Ensure modal is closed on page load
                document.addEventListener('DOMContentLoaded', function() {
                    closeModal();
                });
            </script>
            
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
            <a href="adminprofile.html" class="profile-link">
                <div class="profil-photo">
                    <img src="images/elf wolf 1.jpeg" alt="Profile Picture">
                </div>
            </a>
            <div class="info">
                <label id = "name">[Admin Name]</label>
                <small class="text-muted">Admin</small>
            </div>

        </div>
        </div>
        <!--End of Right Section-->
    </div>
    <main>
        </main>
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
    </script>
    <script></script>
        </body>
</html>