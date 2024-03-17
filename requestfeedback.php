<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/adminscript.js" type="text/javascript"></script>
    <title>ELR Towers Hall Domestic Affairs</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'adm_sidebar.php';?>
            <!--End of Sidebar Section-->
    <main>
        <section class="average-rating">
            <h3>Average Rating</h3>
            <div class="stars">
                <!-- Dynamically filled with stars based on the average rating -->
            </div>
            <p class="average-score">4.5 / 5</p>
        </section>
                <div>
                    <span class="material-icons-sharp">
                        person
                    </span>
                    <h3>Individual Feedback</h3>
                </div>
            
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Resident Name</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    <tr>
                        <td>req0001</td>
                        <td>John Doe</td>
                        <td>The maintenance service was very prompt and efficient.</td>
                        <td>
                            <div class="stars">
                                <!-- Dynamically filled with stars based on the rating -->
                                <span class="material-icons-sharp">
                                    star star star star star
                            </div>
                    </tr>
                    <!-- Example row -->
                    <tr>
                        <td>req0002</td>
                        <td>Jane Doe</td>
                        <td>The maintenance service was very prompt and efficient.</td>
                        <td>
                            <div class="stars">
                                <!-- Dynamically filled with stars based on the rating -->
                                <span class="material-icons-sharp">
                                    star star star star
                            </div>
                    <!-- More rows will be dynamically inserted here -->
                </tbody>
            </table>
        </section>
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
    <main>
        </main>

</body>
</html>
</body>
</html>
