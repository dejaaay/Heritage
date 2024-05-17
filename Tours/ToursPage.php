<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="../css/tourspage.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
</head>


<body>
    <!-- Header -->
    <?php include "../Navbar/header.php"; ?>

    <!-- Main Content Section -->
    <div class="main-content-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="../img/Welcometopinatubo.png" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-md-6">
                    <div class="right-text">
                        <p>
                            Welcome to Cabalen! In here you can find one of the breathtaking tourist spots that you
                            dont want to miss in your visit in pampanga. Let us help you look for exquisite cuisine,
                            traditional culture, and upcoming events. We want you to have the experience of a lifetime,
                            so come and book now for a tour in the breathtaking places in pampanga!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Button Section -->
<!-- Button Section -->
<div class="text-center">
  <button class="button" onclick="location.href='booking.php'">Tour with us!</button>
</div>
    <?php include "../footer/footer.php"; ?>

    <!-- Include Bootstrap JS and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
