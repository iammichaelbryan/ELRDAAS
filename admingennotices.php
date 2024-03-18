<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <title>ELR Towers Hall Domestic Affairs</title>
    <script src = "js/adminscript.js"></script>
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            overflow-wrap: break-word;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <!--Sidebar Section-->
    <?php include 'adm_sidebar.php';?>
    <!--End of Sidebar Section-->
    <main class="notice-board">
        <h2>Admin Portal</h2>
        <h1>General Notice Board</h1>
        <div class="notices-container">
            <!-- Dynamically load notices here -->
        </div>
    </main>

    <!-- Modal Structure -->
    <div id="noticeModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modalNoticeTitle">Notice Title</h2>
            <p id="modalNoticeDate">Posted on: [Date]</p>
            <p id="modalNoticeAuthor">Posted by: [Author Name]</p>
            <div id="modalNoticeContent">Notice content goes here...</div>
        </div>
    </div>
</div>
<!--Right Section-->

<div class="right-section">
      <div class="nav">
        <button id="menu-btn">
          <span class="material-icons-sharp"> menu </span>
        </button>
        <div class="dark-mode">
          <span class="material-icons-sharp active"> light_mode </span>
          <span class="material-icons-sharp"> dark_mode </span>
        </div>
        <div class="profile">
          <a href="profile.php" class="profile-link">
            <div class="profil-photo">
              <img src="images/elf wolf 1.jpeg" alt="Profile Picture" />
            </div>
          </a>
          <div class="info">
            <p>
              <!-- Hey<b
                ><span id="residentName"
                ><?php echo $_SESSION['first_name']; ?></span
                >!</b -->
              >
            </p>
            <small class="text-muted">Resident</small>
          </div>
        </div>
      </div>
      <!--End of Right Section-->
    
      <script>
    document.addEventListener("DOMContentLoaded", function () {
        const noticesContainer = document.querySelector(".notices-container");
        let notices = [];

        function fetchNotices() {
            fetch("fetch_notices.php")
                .then(response => response.json())
                .then(data => {
                    // Ensure the data is an array of notices
                    if (Array.isArray(data)) {
                        notices = data;
                        renderNotices();
                    } else {
                        // Handle cases where data is not as expected
                        console.error('Unexpected data format:', data);
                    }
                })
                .catch(error => {
                    console.error("Error fetching notices:", error);
                });
        }

        function renderNotices() {
            noticesContainer.innerHTML = ""; // Clear existing notices
            notices.forEach((notice, index) => {
                const noticeHTML = `
                    <div class="notice">
                        <h2>${notice.notice_subject}</h2>
                        <p class="notice-date">Posted on: ${notice.notice_date} at ${notice.notice_time}</p>
                        <p class="notice-author">Posted by: ${notice.first_name} ${notice.last_name}</p>
                        <div class="notice-body">
                            <p class="notice-content">${notice.notice_content.substring(0, 100)}...</p>
                            <button class="view-more-btn" onclick="viewMoreNotice(${index})">View More</button>
                        </div>
                    </div>`;
                noticesContainer.insertAdjacentHTML("beforeend", noticeHTML);
            });
        }

        window.viewMoreNotice = function(index) {
            const notice = notices[index];
            // Set modal content dynamically based on the selected notice
            document.getElementById('modalNoticeTitle').innerText = notice.notice_subject;
            document.getElementById('modalNoticeAuthor').innerText = `Posted by: ${notice.first_name} ${notice.last_name}`;
            document.getElementById('modalNoticeDate').innerText = `Posted on: ${notice.notice_date}`;
            document.getElementById('modalNoticeContent').innerText = notice.notice_content;
            document.getElementById('noticeModal').style.display = 'block'; // Show modal
        };

        window.closeModal = function() {
            document.getElementById('noticeModal').style.display = 'none'; // Hide modal
        };

        fetchNotices(); // Fetch notices when the page loads
    });
</script>
</body>
</html>
