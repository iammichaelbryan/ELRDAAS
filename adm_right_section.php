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
            <p> Welcome, </p>
            <p id="first_name"><b></b></p>
            <small class="text-muted">Admin</small>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const fetchUserName = () => {
            fetch('fetch_first_name.php')
              .then(response => {
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(first_name => {
                if (first_name.error) {
                  console.error(first_name.error);
                } else {
                  document.getElementById('first_name').textContent = first_name;
                }
              })
              .catch(error => console.error('Error fetching user name:', error));
          };

          fetchUserName();
        });
      
        </script>
      <!--End of Right Section-->