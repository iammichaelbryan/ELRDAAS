<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notificationstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/notifications.js"></script>
    <script src="js/adminscript.js"></script>
    <title>ELR Towers Hall Domestic Affairs</title>
</head>
<body>
    <div class="container">
        <!--Sidebar Section-->
        <?php include 'adm_sidebar.php';?>
        <!--End of Sidebar Section-->
    
    <main>
        <div class="Notification-Section">
            <h1>Admin Notification Section</h1>
            <button onclick="showNotification()"><h2>Click here to Show Notifications</h2></button>
            
            <div id="notification" class="hidden">
                <ul>
                    <li>There are no requests left to be assigned </li>
                    <li>There are currently 2 unassigned requests</li>
                </ul>
                <span onclick="hideNotification()">X Click the 'X' to close Notifications</span>
            </div>
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
            <a href="adminprofile.php" class="profile-link">
                <div class="profil-photo">
                    <img src="images/elf wolf 1.jpeg" alt="Profile Picture">
                </div>
            </a>
            <div class="info">
                <p>Hey, <b>[Admin Name]</b></p>
                <small class="text-muted">Admin</small>
            </div>
        </div>
        </div>
        <!--End of Right Section-->
    </div>
    </div>
    </body>
    </html>

</body>
</html>
