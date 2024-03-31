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

                    <button id="removeAdminBtn" onclick="removeResident()">Remove My Resident Account</button>
                </div>
            </main>

            <!--Right Section-->
            <?php include 'res_right_section.php';?>
            <!--End of Right Section-->
            <script>
                            // Make an AJAX request to retrieve the resident's name and email
                            var xhr = new XMLHttpRequest();
                                    xhr.open('GET', 'fetch_user_data.php', true);
                                    xhr.onload = function() {
                                    if (xhr.status === 200) {
                                    var residentData = JSON.parse(xhr.responseText);
                                    if (residentData.error) {
                                    console.error(residentData.error);
                                    } else {
                                    // Set the admin's name and email in the HTML
                                    document.getElementById("residentName").textContent = residentData.firstName + " " + residentData.lastName;
                                    document.getElementById("residentEmail").textContent = "Email: " + residentData.email;
                                }
                            } else {
                                console.error("Error fetching data");
                            }
                        };
                        xhr.send();
                            function removeResident() {
                                    var confirmRemove = confirm("Are you sure you want to remove your resident account?");
                                    if (confirmRemove) {
                                        // Add logic to remove the resident account
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'remove_resident.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                            xhr.onload = function() {
                                            if (xhr.status === 200) {
                                            console.log("Resident account removed successfully");
                                            window.location.href = "login.html";
                                        } else {
                                            console.error("Error removing resident account");
                                        }
                                    };
                                    xhr.send();
        }
    }
                        </script>
        </div>
    </body>
</html>