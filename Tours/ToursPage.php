<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <style>
        /* CSS styling */
        .main-content-container {
            display: flex;
            align-items: stretch;
        }
        .col-md-6 {
            display: flex;
            align-items: stretch;
        }
        .right-text {
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 28px;
            padding: 20px; /* Added padding for spacing */
            display: flex;
            align-items: center; /* Align text vertically */
        }

        .main-content-container img {
            height: 100%;
            object-fit: cover;
        }

/* Apply the provided styles to the button */
button {
  padding: 1.3em 3em;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  -webkit-box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  -webkit-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}

button:hover {
  background-color: #23c483;
  -webkit-box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  -webkit-transform: translateY(-7px);
  -ms-transform: translateY(-7px);
  transform: translateY(-7px);
}

button:active {
  -webkit-transform: translateY(-1px);
  -ms-transform: translateY(-1px);
  transform: translateY(-1px);
}


    </style>
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
                            Welcome to Cabalen! In here you can find one of the breathetaking tourist spots that you
                            dont want to miss in your visit in pampanga. Let us help you look for exquisite cuisine,
                            traditional culture, and upcoming events. We want you to have the experience of a lifetime,
                            so come and book now for a tour in the breathetaking places in pampanga!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Button Section -->
<div class="button-container">
    <form action="booking.php" method="get">
        <button class="btn btn-primary" type="submit">Tour with us!</button>
    </form>
</div>


    <?php include "../footer/footer.php"; ?>

    <!-- Include Bootstrap JS and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
