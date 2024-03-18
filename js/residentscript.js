document.addEventListener('DOMContentLoaded', function () {

  const darkModeToggle = document.querySelector(".dark-mode");
  const bodyElement = document.body;
  const dashItems = document.querySelectorAll(".dash-item");

  darkModeToggle.addEventListener("click", () => {
    bodyElement.classList.toggle("dark-mode-variables");
    saveModePreference();
    updateModeIndicator();
  });

  function saveModePreference() {
    const isDarkMode = bodyElement.classList.contains(
      "dark-mode-variables"
    );
    localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
  }

  function loadModePreference() {
    const darkMode = localStorage.getItem("darkMode");
    if (darkMode === "enabled") {
      bodyElement.classList.add("dark-mode-variables");
    } else {
      bodyElement.classList.remove("dark-mode-variables");
    }
  }

  function updateModeIndicator() {
    const isDarkMode = bodyElement.classList.contains(
      "dark-mode-variables"
    );
    const lightIcon = document.querySelector(".dark-mode .light_mode");
    const darkIcon = document.querySelector(".dark-mode .dark_mode");

    if (isDarkMode) {
      lightIcon.classList.add("active");
      darkIcon.classList.remove("active");
    } else {
      lightIcon.classList.remove("active");
      darkIcon.classList.add("active");
    }
  }
  function toggleActive() {
    window.addEventListener('load', () => {
        dashItems.forEach(item => {
            item.classList.remove('active');
            if (item.href == window.location.href) {
                item.classList.add('active')
            }
        });

    });
  }

  toggleActive();
  loadModePreference();
  updateModeIndicator();
});