<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="index.js" aync></script>
    <script src="js/adminscript.js" type="text/javascript"></script>
    <title>ELR Towers Hall Domestic Affairs</title>

</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'adm_sidebar.php';?>
            <!--End of Sidebar Section-->
            <main>
                <link rel="stylesheet" href="laundrmatstyles.css">
                <section class="laundry-appointments"> <!-- New section for laundry appointments -->
                    <h1>Laundromat Appointments</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Random Joe</td>
                                <td>2023-12-01</td>
                                <td>10:00 AM</td>
                                <td>Washing and drying</td>
                            </tr>
                            <!-- Add more rows for additional appointments -->
                        </tbody>
                    </table>
                </section>
                
                <!-- Rest of the main content... -->
    
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
    
</div>


</body>
</html>
