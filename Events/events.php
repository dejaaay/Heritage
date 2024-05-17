<?php
session_start();
include '../connect/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/images/SK-Icon.png"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/events.css">
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <title>Events</title>
</head>

<body>
    <!-- Header -->
    <div>
        <?php include "../Navbar/header.php"; ?>
    </div>

    <!-- Carousel -->
    <div class="main-content-container">
        <div class="carousel">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/morningsun.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/salakot.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/palmtree.jpg" alt="Third slide">
                    </div>
                </div>

                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container">
        <!-- Page title -->
        <h1 class="TitlePage">Events</h1>
    </div>

    <!-- Divider -->
    <hr class="divider" />

<!-- Events section -->
<div class="events">
    <div class="row">
        <?php
        // Query for events
        $sql_customer = "SELECT * FROM `news`";
        $result_customer = mysqli_query($con, $sql_customer);

        if ($result_customer && mysqli_num_rows($result_customer) > 0) {
            while ($row = mysqli_fetch_assoc($result_customer)) {
                // Display events
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card shadow showevent" style="width: 100%; height: 400px;" data-news_name="' . $row['news_name'] . '" data-news_description="' . $row['news_desc'] . '" data-news_date="' . date("F j, Y", strtotime($row['news_date'])) . '" data-news_time="' . date("g:i a", strtotime($row['news_time'])) . '" data-news_image="../admin/dashboard/' . $row['news_img'] . '">';
                echo '<div class="card-header">';
                echo '<h5 class="card-title">' . $row['news_name'] . '</h5>';
                echo '</div>';
                echo '<div class="img-container" style="height: 200px; overflow: hidden;">';
                echo '<img class="card-img-top custom-card-image" src="../admin/dashboard/' . $row['news_img'] . '" alt="news image">';
                echo '</div>';
                
                // Truncate the news description to a specific length (e.g., 150 characters)
                $fullDescription = $row['news_desc'];
                $truncatedDescription = strlen($fullDescription) > 150 ? substr($fullDescription, 0, 150) . '...' : $fullDescription;
                
                echo '<div class="card-body">';
                echo '<p class="card-text">' . date("F j, Y", strtotime($row['news_date'])) . ' ' . date("g:i a", strtotime($row['news_time'])) . '</p>';
                echo '<p class="card-text">' . $truncatedDescription . '</p>'; // Display truncated description
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width:100%;">
                        <img src="..." class="card-img-top" alt="..." id="img-src">
                        <div class="card-body">
                            <h5 class="card-title" id="date-time"></h5>
                            <p class="card-text" id="desc"></p>
                            <p class="card-text" id="price"></p>
                            <p class="card-text" id="venue"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div>
        <?php include "../footer/footer.php"; ?>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Event listener for clicks on event cards
            $(document).on('click', '.showevent', function() {
                // Retrieve the clicked event card
                var eventCard = $(this);
                
                // Retrieve data attributes from the event card
                var newsname = eventCard.data('news_name');
                var eventImageSrc = eventCard.data('news_image');
                var eventDesc = eventCard.data('news_description');
                var eventDate = eventCard.data('news_date');
                var eventTime = eventCard.data('news_time');
                
                // Update modal content
                $('#staticBackdropLabel').text(newsname);
                $('#img-src').attr('src', eventImageSrc).attr('alt', 'Event image');
                $('#date-time').text(eventDate + ' ' + eventTime);
                $('#desc').text(eventDesc);
                
                // Show the modal
                $('#staticBackdrop').modal('show');
            });
        });
    </script>
</body>
</html>
