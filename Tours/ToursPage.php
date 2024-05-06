<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<style>
        /* CSS styling */
        .container-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            
        }

        .col {
            width: 50%;
        }

        .right-text {
            padding: 150px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 28px;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container-flex {
                flex-direction: column;
            }
            .col {
                width: 100%;
            }
        }
    </style>

<body>
    <!-- add header -->
<?php include "../Navbar/header.php"; ?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../assets/images/SK-Icon.png">
    <!-- Include CSS files -->
    <link rel="stylesheet" href="../css/community.css" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Community</title>
    <style>
        /* CSS styling */
        .container-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            
        }

        .col {
            width: 50%;
        }

        .right-text {
            padding: 150px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 28px;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container-flex {
                flex-direction: column;
            }
            .col {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <?php include "../header/header.php"; ?>

     <!-- Main Content Section -->
     <div class="main-content-container">
        <!-- add a carousell with a clickable button here -->
        <div class="container-flex">
            <div class="row">
                <div class="col">
                <img src = "../img/KuranAmpongPasu.png" height="100%" width="100%"> 
                </div>
                <div class="col">
                    <div class="right-text">
                        <p>
                            Transform your space into a haven of style and comfort with our exquisite selection of furniture. 
                            From sleek modern designs to timeless classics, our curated collection offers something for every taste and lifestyle. 
                            Elevate your home with quality craftsmanship and exceptional value.
                            Discover the perfect pieces to express your unique aesthetic and make every room a masterpiece.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form action="booking.php" method="get">
            <button class="pushable" type="submit">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">
                    Tour with us!
                </span>
            </button>
        <hr class= "rounded">

    </div>

    <!-- Footer -->
 
    
    <!-- Include JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript Files -->
    <!-- <script src="../javascript/furniture.js"></script>
    <script src="../javascript/header.js"></script> -->
</body>
<?php include "../footer/footer.php"; ?>

</body>
</html>