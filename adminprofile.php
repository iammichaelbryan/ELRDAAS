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
            <?php include 'adm_sidebar.php';?>
            <!--End of Sidebar Section-->

    
    <main class="main-content">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profil-photo">
                <img src="images/elr wolf 4.jpeg" alt="Admin Profile Picture">
                <!-- Add a button or link to change the profile picture -->
                <button class="edit-profile-pic">Change Picture</button>
            </div>
            <!-- Profile Info -->
                <div class="profile-info">
                <h1 id="adminName"></h1>
                <p id="adminEmail"></p>
                <small class="text-muted">Admin</small>
                </div>

            
        
                <!-- Other details -->
                
        </div>
       
    
        <!-- Activity Log -->
        <div class="activity-log">
            <h2>Recent Activity</h2>
            <!-- Add content/log here -->
        </div>
    
        <!-- Account Settings -->
        <div class="account-settings">
            <h2>Account Settings</h2>
            <!-- Add settings options here -->
        </div>
    
        <!-- Contact Support -->
        <div class="contact-support">
            <h2>Need Help?</h2>
            <button>Contact Support</button>
        </div>

        <div class="remove-admin-section">
            <h2>Remove Admin Account</h2>
            <p>If you no longer wish to be an admin, you can remove your admin account here. Please be aware that this action is irreversible.</p>
            <button id="removeAdminBtn" onclick = "removeAdmin()">Remove My Admin Account</button>
        </div>
    </main>
   <!--Right Section-->
<?php include 'adm_right_section.php';?>
      <!--End of Right Section-->
    </div>
    </div>
    <script>
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_user_data.php', true);
                xhr.onload = function() {
                if (xhr.status === 200) {
                var adminData = JSON.parse(xhr.responseText);
                if (adminData.error) {
                console.error(adminData.error);
                } else {
                 // Set the admin's name and email in the HTML
                document.getElementById("adminName").textContent = adminData.firstName + " " + adminData.lastName;
                document.getElementById("adminEmail").textContent = "Email: " + adminData.email;
            }
        } else {
            console.error("Error fetching data");
        }
    };
    xhr.send();

    //Function to remove admin account
    function removeAdmin() {
        var confirmRemove = confirm("Are you sure you want to remove your admin account?");
        if (confirmRemove) {
            // Add logic to remove the admin account
           var xhr = new XMLHttpRequest();
           xhr.open('POST', 'remove_admin.php', true);
              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                if (xhr.status === 200) {
                console.log("Admin account removed successfully");
                window.location.href = "login.html";
            } else {
                console.error("Error removing admin account");
            }
        };
        xhr.send();
        }
    }

</script>
<script src ="js/adminscript.js"></script>

</body>
</html>