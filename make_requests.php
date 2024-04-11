<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - Make a Complaint</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
            <main class="main-content">
                <h2>Resident Portal</h2>
                <h1>Make a Complaint</h1>
                <form class="request-form" action="submitComplaint.php" method="post">
                    <label for="complaint_type">Select Complaint Type:</label>
                    <select name="complaint_type" id="issueType" class="issue-select" required>
                        <option value="Room Issue">Room Issue</option>
                        <option value="Communal Area Issue">Communal Area Issue</option>
                        <option value="General Request">General Request</option>
                    </select>
                    <label for="complaint_body">Describe Your Complaint (Max 150 Characters):</label>
                    <textarea id="complaint_body" name="complaint_body" maxlength="150" placeholder="Enter details of your complaint here... include location info" required></textarea>
                    <button type="submit" class="submit-btn">Submit Complaint</button>
                </form>
            </main>
            
            <!--Right Section-->
            <?php include 'res_right_section.php';?>
            <!--End of Right Section-->
        </div>
    </body>
</html>