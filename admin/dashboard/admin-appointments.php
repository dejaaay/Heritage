<?php
session_start();
include '../../connect/connect.php';

session_start();

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
    <h2>Appointments</h2>
</div>

<div class="container-flex"></div>  
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
                            $stmt_fetch = mysqli_prepare($con, "SELECT * FROM `booking`");

                            // Execute the fetch query
                            mysqli_stmt_execute($stmt_fetch);

                            // Get the result of the fetch query
                            $result_fetch = mysqli_stmt_get_result($stmt_fetch);

                            // Check if the query was successful and the archive event data exists
                            if ($result_fetch && mysqli_num_rows($result_fetch) > 0) {
                                // Fetch all archive event data as an associative array
                                $appointment = mysqli_fetch_all($result_fetch, MYSQLI_ASSOC);

                                // Iterate over each record and create a table row
                                foreach ($appointment as $apptmnt) {

                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($apptmnt['appointment_id']) . '</td>';
                                    echo '<td>' . htmlspecialchars($apptmnt['customer_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($apptmnt['customer_number']) . '</td>';
                                    echo '<td>' . htmlspecialchars($apptmnt['customer_email']) . '</td>';
                                    echo '<td>' . htmlspecialchars($apptmnt['appointment_date']) . '</td>';
                                    echo '<td>' . htmlspecialchars($apptmnt['appointment_time']) . '</td>';
    

                                    // Add buttons for retrieve and delete actions
                                // Add buttons for retrieve and delete actions
                                echo '<td>';

                                // Button to delete the archive event
                                echo '<button class="delete-button" onclick="showConfirmationModal(' . htmlspecialchars($apptmnt['appointment_id']) . ')">Delete</button>';
                                echo '</td>';

                                echo '</tr>';                                    
            }
        } else {
            echo '<tr><td colspan="10" class="text-center">No Appointments found</td></tr>';
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt_fetch);
        ?>
        </tbody>
    </table>

        <script>
            function showConfirmationModal(appointment_id) {
                // Show the confirmation dialog
                if (confirm("Are you sure you want to delete this appointment permanently?")) {
                    // If the user confirms, redirect to the delete script
                    window.location.href = 'delete_from_bookings.php?appointment_id=' + appointment_id;
                }
            }
        </script>

</body>
</html>
