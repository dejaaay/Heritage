<?php
session_start();
include '../../connect/connect.php';

// if (!isset($_SESSION['admin_user'])) {
//     header("Location: ../../login/login.php");
//     exit;
// }

// // Function to sanitize user input
// function sanitizeInput($input) {
//     global $con;
//     return mysqli_real_escape_string($con, $input);
// }

// // // Pagination settings
// // $items_per_page = 5;
// // $page_coffee = isset($_GET['page_coffee']) ? (int)$_GET['page_coffee'] : 1;
// // $page_furniture = isset($_GET['page_furniture']) ? (int)$_GET['page_furniture'] : 1;
// // $page_event = isset($_GET['page_event']) ? (int)$_GET['page_event'] : 1;

// // $offset_coffee = ($page_coffee - 1) * $items_per_page;
// // $offset_furniture = ($page_furniture - 1) * $items_per_page;
// // $offset_event = ($page_event - 1) * $items_per_page;

// // // Calculate total number of coffee items
// // $sql_total_coffee = "SELECT COUNT(*) FROM coffee";
// // $result_total_coffee = mysqli_query($con, $sql_total_coffee);
// // $total_items_coffee = mysqli_fetch_row($result_total_coffee)[0];
// // $total_pages_coffee = ceil($total_items_coffee / $items_per_page);

// // If a coffee item is added, adjust the page number accordingly
// if (isset($_GET['coffee_added'])) {
//     $page_coffee = 1; // Set page to the first page
//     $_SESSION['current_page_coffee'] = $page_coffee; // Reset the session variable
//     // Set active link in session storage
//     $_SESSION['active_link'] = "page_coffee";
// }

// // // Calculate total number of furniture items
// // $sql_total_furniture = "SELECT COUNT(*) FROM furniture";
// // $result_total_furniture = mysqli_query($con, $sql_total_furniture);
// // $total_items_furniture = mysqli_fetch_row($result_total_furniture)[0];
// // $total_pages_furniture = ceil($total_items_furniture / $items_per_page);

// // If a furniture item is added, adjust the page number accordingly
// if (isset($_GET['furniture_added'])) {
//     $page_furniture = 1; // Set page to the first page
//     $_SESSION['current_page_furniture'] = $page_furniture; // Reset the session variable
//     // Set active link in session storage
//     $_SESSION['active_link'] = "page_furniture";
// }

// // Calculate total number of news items
// $sql_total_event = "SELECT COUNT(*) FROM news";
// $result_total_event = mysqli_query($con, $sql_total_event);
// $total_items_event = mysqli_fetch_row($result_total_event)[0];
// $total_pages_event = ceil($total_items_event / $items_per_page);

// // // If an event item is added, adjust the page number accordingly
// // if (isset($_GET['event_added'])) {
// //     $page_event = 1; // Set page to the first page
// //     $_SESSION['current_page_event'] = $page_event; // Reset the session variable
// //     // Set active link in session storage
// //     $_SESSION['active_link'] = "page_event";
// // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/news-dashboard.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Product List</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/SK-Icon.png">
</head>
<body>

<div>
    <?php include "admin-header.php" ?>
</div>
<div class="main-content-container">

<!-- Manage Events -->
<div class="header-container">
    <h2>Manage News</h2>
    <div class="btn-container">
        <!-- Add Event Button -->
        <a href="create-news.php?" class="btn btn-primary">Add Event</a>
    </div>
</div>

<table class="table table-striped event-table">
    <!-- Event Table Header -->
    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include database connection
                        include('../../connect/connect.php');

                        // Prepare the fetch query for archive_event table
                        $stmt_fetch = mysqli_prepare($con, "SELECT * FROM `news`");

                        // Execute the fetch query
                        mysqli_stmt_execute($stmt_fetch);

                        // Get the result of the fetch query
                        $result_fetch = mysqli_stmt_get_result($stmt_fetch);

                        // Check if the query was successful and the archive event data exists
                        if ($result_fetch && mysqli_num_rows($result_fetch) > 0) {
                            // Fetch all archive event data as an associative array
                            $news = mysqli_fetch_all($result_fetch, MYSQLI_ASSOC);

                            // Iterate over each record and create a table row
                            foreach ($news as $nws) {

                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($nws['news_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($nws['news_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($nws['news_desc']) . '</td>';
                                echo '<td>' . htmlspecialchars($nws['news_date']) . '</td>';
                                echo '<td>' . htmlspecialchars($nws['news_time']) . '</td>';
                                echo "<td><img src='" . htmlspecialchars($nws['news_img']) . "' alt='News Image' class='coffee-image'></td>";


                                // Add buttons for retrieve and delete actions
                                echo "<td>";
                               
                                echo "</td>";

                                echo "<td>";
                                echo "<a href='update-news.php?updateid=" . $nws['news_id'] . "' class='btn btn-success m-2 text-light btnUpdate'>Update</a>";
                                echo "<a href='delete-news.php?deleteid=" . $nws['news_id'] . "' class='btn btn-danger m-2 text-light btnArchive' onclick='return confirm(\"Are you sure you want to delete this news?\")'>Delete</a>";
                                echo "</td>";

                                // Button to delete the archive event
                                
        }
    } else {
        echo '<tr><td colspan="10" class="text-center">No News found</td></tr>';
    }
    ?>
    </tbody>
</table>
<script>
// Function to handle pagination link click for all tables
function handlePaginationClick(news) {
    var clickedHref = news.target.href;
    var tableType = news.target.classList.contains('page-coffee') ? 'Coffee' :
                    news.target.classList.contains('page-furniture') ? 'Furniture' :
                    news.target.classList.contains('page-news') ? 'Events' : null;
    if (tableType) {
        sessionStorage.setItem("active" + tableType + "Link", clickedHref);
        setActiveLink(tableType, clickedHref);
    }
}

// Function to set the "active" class on the correct pagination link
function setActiveLink(tableType, clickedHref) {
    var paginationLinks = document.querySelectorAll(".page-" + tableType.toLowerCase());
    paginationLinks.forEach(function(link) {
        if (link.href === clickedHref) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
}

// Function to set the "active" class on the correct pagination link on page load
function setActiveLinksOnLoad() {
    var activeCoffeeLink = sessionStorage.getItem("activeCoffeeLink");
    var activeFurnitureLink = sessionStorage.getItem("activeFurnitureLink");
    var activeEventsLink = sessionStorage.getItem("activeEventsLink");

    if (activeCoffeeLink) {
        setActiveLink("coffee", activeCoffeeLink);
    }
    if (activeFurnitureLink) {
        setActiveLink("furniture", activeFurnitureLink);
    }
    if (activeEventsLink) {
        setActiveLink("events", activeEventsLink);
    }
}

// Add news listener for pagination link clicks
document.addEventListener('DOMContentLoaded', function() {
    var paginationLinks = document.querySelectorAll('.page-coffee, .page-furniture, .page-news');
    paginationLinks.forEach(function(link) {
        link.addEventListener('click', handlePaginationClick);
    });

    // Set active links on page load
    setActiveLinksOnLoad();
});
</script>
</body>
</html>
