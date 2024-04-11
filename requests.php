<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>ELR Towers Hall Domestic Affairs</title>
    <style>
        /* Add CSS rule to style the last row of the table */
        .requests-table tbody tr:last-child td {
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <!--Sidebar Section-->
    <?php include 'adm_sidebar.php';?>
    <!--End of Sidebar Section-->
    <main class="main-content">
        <h1>Assigned Complaints</h1>
        <table class="requests-table">
            <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Resident Name</th>
                <th>Resident ID</th>
                <th>Tower</th>
                <th>Complaint Type</th>
                <th>Complaint Description</th>
                <th>Date Submitted</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            include 'db_connect.php';

            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            $sql = "SELECT * FROM complaints";
            $complaints = $conn->query($sql);
            if(!$complaints){
                echo "Error: ";
            }

            while ($row = $complaints->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                            <td>".$row["complaint_id"]."</td>
                            <td>". $row["first_name"],' ',$row["last_name"]."</td>
                            <td>".$row["resident_id"]."</td>
                            <td>".$row["tower"]."</td>
                            <td>".$row["complaint_type"]."</td>
                            <td>".$row["complaint_body"]."</td>
                            <td>".$row["date_submitted"]."</td>
                            <td>
                            <select class='status-select' name='status' onchange='saveChanges(this, \"".$row["id"]."\")'>
                            <option value='Pending Assignment' ".($row["status"] == 'Pending Assignment' ? 'selected' : '').">Pending Assignment</option>
                            <option value='Assigned' ".($row["status"] == 'Assigned' ? 'selected' : '').">Assigned</option>
                            <option value='In Progress' ".($row["status"] == 'In Progress' ? 'selected' : '').">In Progress</option>
                            <option value='Resolved' ".($row["status"] == 'Resolved' ? 'selected' : '').">Resolved</option>
                        </select>
                        
                            </td>
                            <td>".$row["assigned_to"]."</td>
                            <td>
                            <select class='priority-select' name='priority' onchange='savePriorityChange(".$row["id"].", this.value)'>
                            <option value='Low' ".($row["priority"] == 'Low' ? 'selected' : '').">Low</option>
                            <option value='Medium' ".($row["priority"] == 'Medium' ? 'selected' : '').">Medium</option>
                            <option value='High' ".($row["priority"] == 'High' ? 'selected' : '').">High</option>
                        </select>
                        
                            </td>
                            <td>
                                <button class='message-btn' onclick='openMessageModal(\"".$row["complaint_id"]."\")'>Message</button>
                            </td>
                        </tr>";
            }
            ?>
            </tbody>

        </table>
    </main>

    <!-- Modal Structure -->
    <div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Send Message</h2>
        <!-- Include a hidden input to store the complaint ID -->
        <input type="hidden" id="complaintId" value="">
        <textarea id="messageText" placeholder="Write your message here..."></textarea>
        <button id="sendButton" class="send-message-btn">Send</button>
    </div>
</div>

<!--Right Section-->
<?php include 'adm_right_section.php';?>
      <!--End of Right Section-->
</div>

    <script>
        // Function to open the message modal
window.openMessageModal = function(requestId) {
    document.getElementById('messageModal').style.display = 'block';
    document.getElementById('messageText').value = ''; // Clear the textarea
    document.getElementById('complaintId').value = requestId; // Set the current complaint ID
    console.log("Opening message modal for request ID:", requestId);
};

// Modify the closeModal and sendMessage functions if necessary
function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
    // Optionally clear the textarea here too if users can also close the modal without sending a message
    document.getElementById('messageText').value = '';
}

function sendMessage() {
    var message = document.getElementById('messageText').value;
    var complaintId = document.getElementById('complaintId').value; // Retrieve the complaint ID

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL /update_message.php
    xhr.open('POST', 'update_message.php', true);

    // Set the request header
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Send the request over the network
    xhr.send('complaintId=' + encodeURIComponent(complaintId) + '&message=' + encodeURIComponent(message));

    xhr.onload = function() {
        if (xhr.status != 200) { // analyze HTTP response
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else { // show the result
            alert(`Done, got ${xhr.response.length} bytes`); // response is the server
        }
    };

    xhr.onerror = function() {
        alert("Request failed");
    };

    closeModal(); // Close the modal after sending the message
}

// Attach sendMessage to the send button inside the modal
document.getElementById('sendButton').addEventListener('click', sendMessage);

// Ensure modal is closed on page load
document.addEventListener('DOMContentLoaded', function() {
    closeModal();
});
function saveChanges(selectElement, complaintId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Handle success
            console.log(this.responseText);
        }
    }
    xhr.send("complaintId=" + complaintId + "&fieldName=" + selectElement.name + "&fieldValue=" + selectElement.value);

}

function savePriorityChange(complaintId, priority) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Handle success
            console.log(this.responseText);
        }
    }
    xhr.send("complaintId=" + complaintId + "&fieldName=priority&fieldValue=" + priority);
}
    </script>

</div>

<!-- Include the JavaScript code here -->
<script src="js/adminscript.js"></script>
</body>
</html>
