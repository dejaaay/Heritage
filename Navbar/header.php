<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/header.css" />
  <title>Header</title>
  <style>
    /* Additional CSS for sticky header */
    .coffee-shop-header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      transition: transform 0.3s ease-out;
    }

    .container {
      padding: 10px 0;
      /* Add padding to container to adjust for sticky header */
    }

    .coffee-shop-header.hidden {
      transform: translateY(-100%);
      transition: transform 0.8s ease-in-out;
      /* Smooth transition */
    }
  </style>
</head>

<body>
  <header class="coffee-shop-header" id="header">
    <div class="container">
      <nav>
        <div class="logo-container">
          <a href="../landingpage/LandingPage.php" onclick="handleNavClick(event)">
            <img src="../img/CabalenLight.png" alt="CabelenLogo" class="StreetKohiLogo" />
          </a>
        </div>
        <div class="nav-links-container">
          <ul>
            <li><a href="../LandingPage/LandingPage.php" onclick="handleNavClick(event)" class="nav-links">Home</a></li>
            <li><a href="../Blogs/gallery.php" onclick="handleNavClick(event)" class="nav-links">Blogs</a></li>
            <li><a href="../Events/events.php" onclick="handleNavClick(event)" class="nav-links">Events</a></li>
            <li><a href="../videos/videos.php" onclick="handleNavClick(event)" class="nav-links">Videos</a></li>
            <li><a href="../Tours/ToursPage.php" onclick="handleNavClick(event)" class="nav-links">Tours</a></li>

  </header>

  <script src="../javascript/header.js"></script>
  <script>
    // Hamburger menu functionality
    document.getElementById("hamburger").addEventListener("click", function() {
      console.log("Hamburger icon clicked");
      var menu = document.querySelector(".menu");
      menu.classList.toggle("active");
      console.log(
        "Menu active class toggled:",
        menu.classList.contains("active")
      );
    });
    document.addEventListener("DOMContentLoaded", function() {
      // Function to calculate and apply padding
      function adjustContentPadding() {
        var headerHeight = document.getElementById("header").offsetHeight;
        var mainContent = document.querySelector(".main-content-container"); // Adjust the selector as needed
        if (mainContent) {
          mainContent.style.paddingTop = headerHeight + "px";
        }
      }

      // Call the function on page load
      adjustContentPadding();

      // Call the function on window resize to adjust padding if the header height changes
      window.addEventListener("resize", adjustContentPadding);
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var lastScrollTop = 0; // Variable to store the last scroll position
      var header = document.getElementById("header"); // Reference to the header

      // Function to handle scroll events
      function handleScroll() {
        var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        // If the current scroll position is greater than the last scroll position, the user is scrolling down
        if (currentScroll > lastScrollTop) {
          header.classList.add("hidden"); // Hide the header
        } else {
          header.classList.remove("hidden"); // Show the header
        }

        lastScrollTop = currentScroll; // Update the last scroll position
      }

      // Attach the scroll event listener
      window.addEventListener("scroll", handleScroll);

      // Function to calculate and apply padding
      function adjustContentPadding() {
        var headerHeight = document.getElementById("header").offsetHeight;
        var mainContent = document.querySelector(".main-content-container"); // Adjust the selector as needed
        if (mainContent) {
          mainContent.style.paddingTop = headerHeight + "px";
        }
      }

      // Call the function on page load
      adjustContentPadding();

      // Call the function on window resize to adjust padding if the header height changes
      window.addEventListener("resize", adjustContentPadding);
    });
  </script>

</body>

</html>