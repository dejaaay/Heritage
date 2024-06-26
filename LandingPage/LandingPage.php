<?php ?>
<!doctype html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    
    <link href="../css/Landing.css" type="text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    #carouselExampleControls {
        margin-top: 180px;
    }
</style>

<?php include "../Navbar/header.php"; ?>

<body>
    <!-- Greetings card na naka carousell part -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card text-white">
                    <img src="../img/new_balloon.jpg" class="card-img" alt="First slide">
                    <div class="card-img-overlay">
                        <h1 class="card-title1">Hot Air Balloon Festival</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="card text-white">
                    <img src="../img/pinatubo.jpg" class="card-img" alt="second slide">
                    <div class="card-img-overlay">
                        <h1 class="card-title1">Mt. Pinatubo Crater Lake</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="card text-white">
                    <img src="https://i0.wp.com/www.angsarap.net/wp-content/uploads/2019/11/Bringhe-Wide.jpg?ssl=1" class="card-img" alt="third slide">
                    <div class="card-img-overlay">
                        <h1 class="card-title1">Bringhe</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="card text-white">
                    <img src="../img/sinukwan_festival.jpg" class="card-img" alt="fourth slide">
                    <div class="card-img-overlay">
                        <h1 class="card-title1">Sinukwan Festival</h1>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <br>
    <!-- about the page -->
    <!-- Content Section 1 -->
    <section id="scroll">
        <div class="container">
            <div class="row">
                <div class="col-md showcase-container">
                    <div class="card showcase-card">
                        <img src="../img/ParolPaint.jpg"
                            alt="image1" class="background" />
                    </div>
                </div>
                <div class="col-md showcase-container">
                    <div class="card showcase-card">
                        <img src="../img/PinatuboPortrait.png"
                            alt="image2" class="background" />
                    </div>
                </div>
                <div class="col-md showcase-container">
                    <div class="card showcase-card">
                        <img src="../img/food.jpg"
                            alt="image3" class="background " />
                    </div>
                </div>
                <div class="col-md pt-1 showcase-container">
                    <div class="row gy-4">
                        <div class="card border-0 showcase-card-right">
                            <img src="../img/dase.png"
                            alt="image3" class="background rounded" />
                        </div>
                        <div class="card border-0 showcase-card-right">
                            <img src="../img/clarkair.jpg"
                            alt="image3" class="background rounded" />
                        </div>
                    </div>
                </div>
            </div>    
        </section>


    <br>
    <br>
    <!--Video part-->
    <iframe class="center" width=100% height="900" src="https://www.youtube.com/embed/-3k-SC22zbA?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>
    <br>
    <!--News And Blogs-->
    <hr>
    <br>
    <?php include "../footer/footer.php"; ?>
</body>

</html>