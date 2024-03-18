<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/adminscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'adm_sidebar.php';?>
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

                       include 'db_connect.php';
                       
                       //retrieve requests from the database
                       $sql = "SELECT * FROM complaints";
                       $complaints = $conn->query($sql);
                       if(!$complaints){
                        echo "Error: ";
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
   
        </body>
</html>