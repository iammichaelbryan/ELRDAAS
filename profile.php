<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - Resident Profile</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
            <main class="main-content">
                <!-- Profile Header -->
                <h2>Resident Portal</h2>
                <div class="profile-header">
                    <div class="profil-photo">
                        <img src="images/elr wolf 4.jpeg" alt="Resident Profile Picture">
                        <!-- Add a button or link to change the profile picture -->
                        <button class="edit-profile-pic">Change Picture</button>
                    </div>
                    <!-- Right Section Info -->
                    <div class="profile-info">
                        <h1 id="residentName"></h1>
                        <p id="residentEmail"></p>

                        <script>
                            // Make an AJAX request to retrieve the resident's name and email
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'login_process.php', true);
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var residentData = JSON.parse(xhr.responseText);
                                    var firstName = residentData.firstName;
                                    var lastName = residentData.lastName;
                                    var email = residentData.email;

                                    // Set the resident's name and email in the HTML
                                    document.getElementById("residentName").textContent = firstName + " " + lastName;
                                    document.getElementById("residentEmail").textContent = "Email: " + email;
                                }
                            };
                            xhr.send();
                        </script>
                    <small class="text-muted">Resident</small>
                </div>
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
                    <h2>Remove Resident Account</h2>

                    <p>If you no longer wish to be a member resident, you can remove your resident account here. Please be aware that this action is irreversible.</p>
                    <p>If you wish to delete your account, you can do so here. Please be aware that this action is irreversible.</p>

                    <button id="removeAdminBtn">Remove My Resident Account</button>
                </div>
            </main>

            <!--Right Section-->
            <div class="right-section">
                <div class="nav">
                    <button id="menu-btn">
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
                        <!-- Right Section Info -->
                        <div class="info">
                            <h1 id="residentName"></h1>
                            <small class="text-muted">Resident</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Right Section-->
        </div>
    </body>
</html>