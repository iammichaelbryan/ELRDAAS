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
            <!-- Settings Section -->
                <!-- Notice Board Section -->
                <main class="notice-board">
                    <h1>General Notice Board</h1>
                    <div class="notices-container">
                        <!-- Dynamically load notices here -->
                        <div class="notice">
                            <h2>Subject of Notice</h2>
                            <p class="notice-date">Posted on: [Date]</p>
                            <div class="notice-body">
                                <p class="notice-content">Brief details of the notice...</p>
                                <button class="view-more-btn" onclick="viewMoreNotice()">View More</button>
                            </div>
                        </div>
                        <!-- Repeat for other notices -->
                    </div>
                </main>
        
    </div>
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
                <p>Hey, <b>[Admin Name]</b></p>
                <small class="text-muted">Admin</small>
            </div>
        </div>
        </div>
        <!--End of Right Section-->
    </div>
    </body>
</html>