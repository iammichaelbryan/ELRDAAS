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
                                <th> Appointment ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service</th>
                                <th>Loads</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            include 'db_connect.php'; // Include the database connection file

            $sql = "SELECT * FROM appointments";
            $appointments = $conn->query($sql);
            if(!$appointments){
                echo "Error: ";
            }

            while ($row = $appointments->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                            <td>".$row["appointment_id"]."</td>
                            <td>". $row["resident_first_name"],"</td>
                            <td>".$row["resident_last_name"]."</td>
                            <td>".$row["appointment_date"]."</td>
                            <td>".$row["appointment_time"]."</td>
                            <td>".$row["service"]."</td>
                            <td>".$row["loads"]."</td>
                            <td>".$row["cost"]."</td>
                        </tr>";
            }
            ?>
                            <!-- Add more rows for additional appointments -->
                        </tbody>
                    </table>
                </section>
                
                <!-- Rest of the main content... -->
    
            </main>
<!--Right Section-->
<?php include 'adm_right_section.php';?>
      <!--End of Right Section-->
    </div>

        
</div>
    
</div>


</body>
</html>
