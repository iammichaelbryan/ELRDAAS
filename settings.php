<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - Make a Request</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
           
                   <!-- Settings Section -->
        <main class="settings-section">
            <h2>Resident Portal</h2>
            <h1>Settings</h1>
            <div class="settings-container">
                <div class="setting-item">
                    <h2>Change Password</h2>
                    <form id="changePasswordForm">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword">
                        
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword">

                        <label for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword">

                        <input type="submit" value="Update Password">
                    </form>
                </div>
                <div class="setting-item">
                    <h2>Notification Settings</h2>
                    <form id="notificationSettingsForm">
                        <label>
                            <input type="checkbox" name="emailNotifications">
                            Email Notifications
                        </label>
                        <label>
                            <input type="checkbox" name="smsNotifications">
                            In-App Notifications
                        </label>
                        <input type="submit" value="Save Settings">
                    </form>
                </div>
                <!-- Add more settings as needed -->
            </div>
        </main>
            <!--Right Section-->

<?php include 'res_right_section.php';?>
        <!--End of Right Section-->
    </div>

</body>
</html>