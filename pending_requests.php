<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - View Pending Requests</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
            <!-- Main Content Section -->
    <main class="main-content">
        <h2>Resident Portal</h2>
        <h1>Pending Requests</h1>
        <div class="pending-requests">
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Date Submitted</th>
                        <th>Type of Request</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamically load pending requests here -->
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

</body>
</html>