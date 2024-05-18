<?php
session_start();
include '../../connect/connect.php';

//Check user authentication
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: ../login/admin-login.php");
    exit();
}

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
    <title>Restaurant List</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/SK-Icon.png">
</head>

<style>
    body {
        background-color: #FFF2E1;
    }

    .event-table {
        background-color: #D1BB9E;
    }
</style>

</stylbody>

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
                <a href="create-restos.php?" class="btn btn-primary">Add Restos </a>
            </div>
        </div>

        <table class="table table-striped event-table">
            <!-- Event Table Header -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Operation Hour</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                include('../../connect/connect.php');

                // Prepare the fetch query for archive_event table
                $stmt_fetch = mysqli_prepare($con, "SELECT * FROM `restos`");

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
                        echo '<td>' . htmlspecialchars($nws['restos_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($nws['restos_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($nws['restos_desc']) . '</td>';
                        echo '<td>' . htmlspecialchars($nws['restos_oprtn']) . '</td>';
                        echo '<td>' . htmlspecialchars($nws['restos_link']) . '</td>';
                        echo "<td><img src='" . htmlspecialchars($nws['restos_img']) . "' alt='restos Image' class='coffee-image'></td>";


                        // Add buttons for retrieve and delete actions
                        echo "<td>";
                        echo "<a href='update-restos.php?updateid=" . $nws['restos_id'] . "' class='btn btn-success m-2 text-light btnUpdate'>Update</a>";
                        echo "</td>";

                        echo "<td>";

                        echo "<a href='delete-restos.php?deleteid=" . $nws['restos_id'] . "' class='btn btn-danger m-2 text-light btnArchive' onclick='return confirm(\"Are you sure you want to delete this resto?\")'>Delete</a>";
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