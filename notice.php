<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adminstyles.css" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/adminscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs</title>
    </head>
<body>

    <div class="container">
        <!-- Sidebar Section -->
       <?php include 'adm_sidebar.php';?>
        <!-- End of Sidebar Section -->

        <!-- Main Content Section -->
        <main>
            <!-- Create Notice Now Section -->
            <div class="section form-container">
                <h2>Create Notice Now</h2>
                <div>
                    <form action="notice_test.php" method="post">
                        <label for="subject">Subject:</label>
                        <input id="subject" type="text" name="subject" placeholder="Enter Notice subject here"/>

                        <label for="content">Content:</label>
                        <textarea id="content" name="content" placeholder="Enter notice content here"></textarea>
                            
                        <button id="submit">Submit</button>

                        <!-- The hidden author input set by the admin... -->
                        <!--input type="hidden" id="author" name="author" value="Administrator" -->
                    </form>
                </div>    
            </div>

            <!-- Schedule Notice Section -->
            <div class="section form-container">
                <h2>Schedule Notice</h2>
                <form action="notice_schedule.php" method="post">
                    <div class="date-time-container">
                        <div class="date-container">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="time-container">
                            <label for="time">Time:</label>
                            <input type="time" id="time" name="time" required>
                        </div>
                    </div>

                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="content-sche">Content:</label>
                    <textarea id="content-sche" name="content" required></textarea>

                    <button id="submit-sche">Schedule Notice</button>

                    <!-- The hidden author input set by the admin... -->
                    <input type="hidden" id="author" name="author" value="Administrator">
                </form>
            </div>
        </main>
        <!-- End of Main Content Section -->
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
</body>
</html>
