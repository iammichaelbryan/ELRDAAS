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
</script>
        
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
            <button id="removeAdminBtn">Remove My Admin Account</button>
        </div>
    </main>
   <!--Right Section-->
<?php include 'adm_right_section.php';?>
      <!--End of Right Section-->
    </div>
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
    </script>

</body>
</html>