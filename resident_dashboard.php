<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="residentstyles.css" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <script src="js/residentscript.js" defer></script>
    <title>ELR Towers Hall Domestic Affairs</title>
  </head>
  <body>
    <div class="container">
      <!--Sidebar Section-->
      <?php include 'res_sidebar.php';?>
      <!--End of Sidebar Section-->
      <!-- Settings Section -->
      <!-- Notice Board Section -->
      <!-- Notice Board Section -->
      <main class="notice-board">
        <h2>Resident Portal</h2>
        <h1>General Notice Board</h1>
        <div class="notices-container">
          <!-- Dynamically load notices here -->
          <div class="notice">
            <h2>Subject of Notice</h2>
            <p class="notice-date">Posted on: [Date]</p>
            <div class="notice-body">
              <p class="notice-content">Brief details of the notice...</p>
              <button class="view-more-btn" onclick="viewMoreNotice()">
                View More
              </button>
            </div>
          </div>
          <!-- Repeat for other notices -->
        </div>
      </main>
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
          <a href="profile.html" class="profile-link">
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
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          fetchNotices();
          const noticesContainer = document.querySelector(".notices-container");

          // Function to fetch and display notices
          function fetchNotices() {
              fetch("fetch_notices.php")
                  .then((response) => {
                      console.log("Response from server:", response);
                      if (!response.ok) throw new Error("Network response was not ok");
                      return response.json();
                  })
                  .then((notices) => {
                      console.log("Notices:", notices);
                      noticesContainer.innerHTML = ""; // Clear existing notices
                      notices.forEach((notice) => {
                          const noticeHTML = `
                              <div class="notice">
                                  <h2>${notice.notice_subject}</h2>
                                  <p class="notice-date">Posted on: ${notice.notice_date} ${notice.notice_time}</p>
                                  <div class="notice-body">
                                      <p class="notice-content">${notice.notice_content}</p>
                                      <button class="view-more-btn">View More</button>
                                  </div>
                              </div>`;
                          noticesContainer.insertAdjacentHTML("beforeend", noticeHTML);
                      });
                  })
                  .catch((error) => {
                      console.error("Error fetching notices:", error);
                  });
          }

            
        });
    </script>
    </body>
    </html>

  </body>
</html>
