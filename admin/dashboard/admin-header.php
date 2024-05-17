<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/header.css" />
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

    /* Logout button */
    .Btn-logout {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: .3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: rgb(255, 65, 65);
}

/* plus sign */
.sign-logout {
  width: 100%;
  transition-duration: .3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign-logout svg {
  width: 17px;
}

.sign-logout svg path {
  fill: white;
}
/* text */
.text-logout {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 600;
  transition-duration: .3s;
}
/* hover effect on button width */
.Btn-logout:hover {
  width: 125px;
  border-radius: 40px;
  transition-duration: .3s;
}

.Btn-logout:hover .sign {
  width: 30%;
  transition-duration: .3s;
  padding-left: 20px;
}
/* hover effect button's text */
.Btn-logout:hover .text {
  opacity: 1;
  width: 70%;
  transition-duration: .3s;
  padding-right: 10px;
}
/* button click effect*/
.Btn-logout:active {
  transform: translate(2px ,2px);
}

  </style>
</head>

<body>
  <header class="coffee-shop-header" id="header">
    <div class="container">
      <nav>
        <div class="logo-container">
          <a href="" onclick="handleNavClick(event)">
            <img src="../../img/CabalenLight.png" alt="CabelenLogo" class="StreetKohiLogo" />
          </a>
        </div>
        <div class="nav-links-container">
          <ul>
            <li><a href="admin-news.php" onclick="handleNavClick(event)" class="nav-links">News<News /a>
            </li>
            <li><a href="admin-appointments.php" onclick="handleNavClick(event)" class="nav-links">Appointments</a></li>
            <li><a href="admin-restos.php" onclick="handleNavClick(event)" class="nav-links">Restaurants</a></li>

            <a class="Btn-logout" href="../login/logout.php">
  
  <div class="sign-logout"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
  
  <div class="text-logout">Logout</div>
  </a>
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