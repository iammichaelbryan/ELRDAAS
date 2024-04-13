<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notificationstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <script src="notifications.js"></script>
    <title>ELR Towers Hall Domestic Affairs</title>
</head>
<body>
    <div class="container">
        <!--Sidebar Section-->
        <?php include 'res_sidebar.php';?>
        <!--End of Sidebar Section-->
    
    <main>
        
        <div class="Notification-Section">
            
            <h1>Resident Notification Section</h1>
            <button onclick="showNotification()"><h2>Click here to Show Notifications</h2></button>
            
            <div id="notification" class="hidden">
                <ul>
                    <?php
                    
                    include 'db_connect.php';
                    include 'fetch_user_data.php';

                    $userID = $_SESSION['userID'];

                    // Fetch notifications for the logged in user
                    $sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['user_id' => $user_id]);
                    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <!-- Display notifications -->
                    <div id="notification" class="hidden">
                        <ul>
                            <?php foreach ($notifications as $notification): ?>
                                <li><?= htmlspecialchars($notification['message']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <span onclick="hideNotification()">X Click the 'X' to close Notifications</span>
                    </div>
                </ul>
                <span onclick="hideNotification()">X Click the 'X' to close Notifications</span>
            </div>
        </div>
    </main>
        <!--Right Section-->
        <?php include 'res_right_section.php';?>

<!--End of Right Section-->
    </div>
    </div>
    

    
    </body>
    </html>

</body>
</html>
