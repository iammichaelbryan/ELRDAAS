<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>ELRDAAS Admin's Interface</title>
    
</head>
<body>
    <?php include 'adm_sidebar.php';?>
        <!--End of Sidebar Section-->

        <!--Main Section-->
       
<main>
    <h1>Admin's Portal</h1>
    <!--Analytics-->
    <div class="analysis">
        <div class="panel">
            <div class="status">
                <div class="info">
                    <h3>Total Assigned Complaints</h3>
                    <?php
                    // Include database connection
                    include 'db_connect.php';

                    try {
                        // Fetch total assigned requests count from the database
                        $sql = "SELECT COUNT(*) AS total_assigned_requests FROM complaints";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $totalAssignedRequests = $result['total_assigned_requests'];

                        echo "<h1>{$totalAssignedRequests}</h1>";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
                                    
                </div>
                </div>
        <div class="panel">
            <div class="status">
                <div class="info">
                    <h3>Complaints Resolved by Admin</h3>
                    <?php
                    try {
                        // Fetch resolved requests count from the database
                        $sql = "SELECT COUNT(*) AS resolved_requests FROM complaints WHERE status = 'Resolved'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $resolvedRequests = $result['resolved_requests'];

                        echo "<h1>{$resolvedRequests}</h1>";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
                <div class="progress">
    <?php
    // Calculate percentage resolved
    $percentageResolved = ($resolvedRequests / $totalAssignedRequests) * 100;

    // Define the radius of the circle
    $radius = 25; // as per your SVG

    // Calculate the circumference of the circle
    $circumference = 2 * M_PI * $radius;

    // Calculate the stroke dash offset, which is the length that is not "filled"
    $dashOffset = $circumference * ((100 - $percentageResolved) / 100);
    ?>
    <svg viewBox="0 0 60 60">
        <circle cx="30" cy="30" r="<?= $radius ?>" stroke="#4caf50" stroke-width="5" fill="none"
                stroke-dasharray="<?= $circumference ?>" stroke-dashoffset="<?= $dashOffset ?>"></circle>
    </svg>                    
    <div class="percentage">
        <p><?= round($percentageResolved) ?><span>%</span></p>
    </div>
</div>

            </div>
        </div>
        <div class="panel">
    <div class="status">
        <div class="info">
            <h3>Average hours to get resident complaint resolved</h3>
            <h2>25.1</h2> 
        </div>
    </div>
</div>

            </div>
            <!--End of Analytics-->
            <!--Start of New User-->
            <div class="new-users">
                <h2>New Admins</h2>
                <div class="user-list">
                    <div class="user">
                        <div class="user-info">
                            <img src="images/ELR DAAS Shaniel Dennis.webp" alt="user">
                            <div class="user-name">
                                <h3>Shaniel Dennis</h3>
                                <p>Resident Advisor</p>
                                <p>joined 54 Min Ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="user">
                        <div class="user-info">
                            <img src="images/ELR DAAS Rajaye.png" alt="user">
                            <div class="user-name">
                                <h3>Rajaye Bennett</h3>
                                <p>Domestic Affairs Chairperson</p>
                                <p>joined 5 Hrs Ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="user">
                        <div class="user-info">
                            <img src="images/ELRDAAS Erica Harris.webp" alt="user">
                            <div class="user-name">
                                <h3>Erica Harris</h3>
                                <p>Senior Resident Advisor</p>
                                <p>joined 23 Hrs Ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="user">
                        <div class="user-info">
                            <img src="images/ELR DAAS BERTRAM.webp" alt="user">
                            <div class="user-name">
                                <h3>Mr. Bertram Anderson</h3>
                                <p>Student Services and Development Manager</p>
                                <p>joined 2 Days Ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="user">
                        <div class="user-info">
                            <button id="add-admin-button" class="add-button" onclick="window.location.href='register.html'">+</button>
                            <div class="user-name">
                                <p>Add New Admin</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--End of New User-->
            <!--Start of Recent Activities-->
            <div class="recent-requests">
            <h2>Recent Complaints</h2>
            <table id="requestsTable" class="animate__animated animate__fadeIn">
                <thead>
                    <tr>
                        <th>Resident Name</th>
                        <th>Complaint Type</th>
                        <th>Complaint ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        // Fetch complaints data from the database
                        $sql = "SELECT * FROM complaints";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Output complaints data as table rows
                        foreach ($complaints as $complaint) {
                            echo "<tr>";
                            echo "<td>{$complaint['first_name']} {$complaint['last_name']}</td>";
                            echo "<td>{$complaint['complaint_type']}</td>";
                            echo "<td>{$complaint['complaint_id']}</td>";
                            echo "<td>{$complaint['date_submitted']}</td>";
                            echo "<td>{$complaint['date_submitted']}</td>";
                            echo "<td>{$complaint['status']}</td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
            <a href="#">View All</a>
        </div>
    </main>
    <!-- End of Main Section -->

                </div>                
        </div>
        
    </div>
        
        </div>
    
    </div>
    
</main>
<!-- End of Main Section -->

<!--Right Section-->
<?php include 'adm_right_section.php';?>
      <!--End of Right Section-->
    </div>

        
</div>
    
</div>

<script src="requests.js"></script>
<script src="index.js"></script>
<script>
    const darkModeToggle = document.querySelector('.dark-mode');
    const bodyElement = document.body;

    darkModeToggle.addEventListener('click', () => {
        bodyElement.classList.toggle('dark-mode-variables');
        saveModePreference();
        updateModeIndicator();
    });

    function saveModePreference() {
        const isDarkMode = bodyElement.classList.contains('dark-mode-variables');
        localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
    }

    function loadModePreference() {
        const darkMode = localStorage.getItem('darkMode');
        if (darkMode === 'enabled') {
            bodyElement.classList.add('dark-mode-variables');
        } else {
            bodyElement.classList.remove('dark-mode-variables');
        }
    }

    function updateModeIndicator() {
        const isDarkMode = bodyElement.classList.contains('dark-mode-variables');
        const lightIcon = document.querySelector('.dark-mode .light_mode');
        const darkIcon = document.querySelector('.dark-mode .dark_mode');

        if (isDarkMode) {
            lightIcon.classList.add('active');
            darkIcon.classList.remove('active');
        } else {
            lightIcon.classList.remove('active');
            darkIcon.classList.add('active');
        }
    }

    
    loadModePreference();
    updateModeIndicator();
</script>
</body>
</html>