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
            <p id="name"><b></b></p>
            <small class="text-muted">Resident</small>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const fetchUserName = () => {
            fetch('fetch_user_data.php')
              .then(response => {
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(name => {
                if (name.error) {
                  console.error(name.error);
                } else {
                  document.getElementById('name').textContent = name;
                }
              })
              .catch(error => console.error('Error fetching user name:', error));
          };

          fetchUserName();
        });
        </script>
      <!--End of Right Section-->