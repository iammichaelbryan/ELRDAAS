<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="residentstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs - Schedule Laundromat Appointment</title>
</head>
<body>
      <div class="container">
            <!--Sidebar Section-->
            <?php include 'res_sidebar.php';?>
            <!--End of Sidebar Section-->
<!-- Main Content Section -->
<main class="main-content">
    <h2>Resident Portal</h2>
    <h1>Schedule Laundromat Appointment</h1>
    <form class="appointment-form" action="submit_appointment.php" method="post">
        
        <label for="residentFirstName">First Name:</label>
        <input type="text" id="residentFirstName" name="residentFirstName" required>

        <label for="residentLastName">Last Name:</label>
        <input type="text" id="residentLastName" name="residentLastName" required>

        <label for="appointmentDate">Appointment Date:</label>
        <input type="date" id="appointmentDate" name="appointmentDate" required min="2023-11-29">

        <label for="appointmentTime">Preferred Time:</label>
        <input type="time" id="appointmentTime" name="appointmentTime" required>

        <label for="service">Service:</label>
        <select id="service" name="service" required>
            <option value="Wash Only">Wash Only</option>
            <option value="Dry Only">Dry Only</option>
            <option value="Washing & Drying">Washing & Drying</option>
            <option value="Unattended Wash & Dry">Unattended Wash & Dry</option>
        </select>

        <label for="numLoads">Number of Loads ($200 JMD per cycle):</label>
        <select id="numLoads" name="loads" required>
            <option value="1">1 Load</option>
            <option value="2">2 Loads</option>
            <option value="3">3 Loads</option>
        </select>
        
        <p>Appointment Cost= <span id="appointmentCost">$200JMD * Number of Loads </span></p>
        <!-- This is the input that should store the calculated cost -->
        <input type="hidden" id="calculatedCost" name="calculatedCost" value="0">

        
        <p>
            <input type="checkbox" id="agree" name="agree" required>
            <label for="agree">I agree to the <a href="terms_and_conditions.html">Terms and Conditions</a></label>
        </p>
        
        <button type="submit" class="submit-btn">Create Appointment</button>
    </form>
</main>

<script>
    document.getElementById('numLoads').addEventListener('change', calculateCost);
    document.getElementById('service').addEventListener('change', calculateCost);
    
    function calculateCost() {
        var loads = parseInt(document.getElementById('numLoads').value, 10);
        var service = document.getElementById('service').value;
        var costPerLoad = 200; // JMD per load for either washing or drying
        var totalCost = 0;
    
        switch (service) {
            case 'Wash Only':
            case 'Dry Only':
                totalCost = loads * costPerLoad;
                break;
            case 'Washing & Drying':
                totalCost = loads * costPerLoad * 2; // because it's both wash and dry
                break;
            case 'Unattended Wash & Dry':
                // This costs double the regular wash and dry
                totalCost = loads * costPerLoad * 2 * 2;
                break;
            default:
                console.log('Unknown service type');
        }
    
        document.getElementById('appointmentCost').innerText = "Appointment Cost = $" + totalCost + " JMD";
        // This is your calculateCost function which updates the hidden input
        document.getElementById('calculatedCost').value = totalCost; // Make sure the ID matches the input field

    }
    // Trigger calculation on page load in case defaults are set
    window.onload = calculateCost;
    </script>
    
    
<!--Right Section-->

<?php include 'res_right_section.php';?>
        <!--End of Right Section-->
    </div>
    <script>
        // Your existing dark mode toggle script
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

        // Script for scheduling appointments with time intervals and date restrictions
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentDate = document.getElementById('appointmentDate');
            const appointmentTime = document.getElementById('appointmentTime');
            const today = new Date();
            const maxDate = new Date();


            maxDate.setDate(maxDate.getDate() + 3);
            appointmentDate.min = todayString;
            appointmentDate.max = maxDate.toISOString().split('T')[0];

            function populateTimeOptions() {
                const openingTime = 10; // 10 AM
                const closingTime = 19; // 7 PM

                appointmentTime.innerHTML = '';

                for(let hour = openingTime; hour < closingTime; hour++) {
['00', '30'].forEach(minute => {
                        const timeValue = `${hour.toString().padStart(2, '0')}:${minute}`;
                    const option = document.createElement('option');
                    option.value = option.textContent = timeValue;
                        appointmentTime.appendChild(option);
                    });
                }
            }

            populateTimeOptions();
            appointmentDate.addEventListener('change', function() {
                populateTimeOptions();
            });
        });

        // Add other scripts here if needed
document.addEventListener('DOMContentLoaded', function() {
            const appointmentTime = document.getElementById('appointmentTime');
        
            function populateTimeOptions() {
                // Clear existing options
                appointmentTime.innerHTML = '';
        
                for(let hour = 10; hour <= 18; hour++) { // From 10 AM to 6 PM to include the last slot starting at 6:30 PM
                    ['00', '30'].forEach(minute => {
                        // Formatting hour for 24-hour clock system
                        let hourFormatted = hour < 10 ? `0${hour}` : hour;
                        let timeValue = `${hourFormatted}:${minute}`;
                        
                        // Creating option elements for the select dropdown
                        const option = document.createElement('option');
                        option.value = option.textContent = timeValue;
                        // Exclude the 7:30 PM option
                        if (!(hour === 18 && minute === '30')) {
                            appointmentTime.appendChild(option);
                        }
                    });
                }
            }
        
            // Initially populate time options
            populateTimeOptions();
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const appointmentDate = document.getElementById('appointmentDate');
        const maxDate = new Date();
        const today = new Date();
        const todayString = today.toISOString().split('T')[0];
        appointmentDate.min = todayString;


        // Set the maximum allowed date to 3 days from today
        maxDate.setDate(maxDate.getDate() + 3);
        const maxDateString = maxDate.toISOString().split('T')[0];
        
        // Set the maximum attribute of the date input field
        appointmentDate.max = maxDateString;
        
        // Add an event listener to the date input field
        appointmentDate.addEventListener('change', function() {
            const selectedDate = new Date(appointmentDate.value);
            const currentDate = new Date();
            const threeDaysAhead = new Date();

            // Set the date to 3 days ahead of the current date
            threeDaysAhead.setDate(currentDate.getDate() + 3);

            // If the selected date is more than 3 days ahead, reset the value to 3 days ahead
            if (selectedDate > threeDaysAhead) {
                appointmentDate.value = maxDateString;
                alert("You can only schedule appointments up to 3 days in advance.");
            }
        });
    });
</script>



    </body>
    </html>