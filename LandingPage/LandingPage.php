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
                <div class="col-md-4">
                    <!-- Can change to a card with text or text that shows on hover -->

                    <div class="card showcase-card">
                        <img src="../img/2.png"
                            alt="image1" class="background" />
                        <div class="card-content">
                            <h2>Placeholder</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card showcase-card">
                        <img src="../img/1.png"
                            alt="image2" class="background" />
                        <div class="card-content">
                            <h2>Placeholder</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card showcase-card">
                        <img src="../img/3.png"
                            alt="image3" class="background" />
                        <div class="card-content">
                            <h2>Placeholder</h2>
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
    <h1 class="display-4 text-center">News</h1>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-secondary bg-success mb-3" style="width: 25rem; height: auto;">
                    <img src="https://kapampangan.org/wp-content/uploads/2019/06/Pampanga-clay-making-pottery.png" class="card-img-top" alt="pampanga art">
                    <div class="card-body text-white">
                        <h4 class="card-title">Kapampangan Art: The best in the world</h4>
                        <p class="card-text">There is no doubt that Pampanga has a very rich culture and tradition. There are some of these cultures that are famous not only in Pampanga but in the whole country.</p>

                        <div class="card-footer text-center">
                            <a href="https://kapampangan.org/is-there-kapampangan-art/" class="btn btn-primary" target="_blank">View article</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-secondary bg-success mb-3" style="width: 25rem; height: auto;">
                    <img src="https://thehappytrip.com/wp-content/uploads/2019/08/IMG_20190812_095842.jpg" class="card-img-top" alt="Puning Hot Spring">
                    <div class="card-body text-white">
                        <h4 class="card-title">Stakeholders urge reopening of Puning Hot Spring</h4>
                        <p class="card-text">CITY OF SAN FERNANDO Tourism stakeholders are calling for the reopening of the Puning Hot Spring located in between Angeles City and Porac town.</p>
                        <div class="card-footer text-center">
                            <a href="https://www.sunstar.com.ph/article/1944890/pampanga/local-news/stakeholders-urge-reopening-of-puning-hot-spring" class="btn btn-primary text-center" target="_blank">View Article</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-secondary bg-success mb-3" style="width: 25rem; height: auto;">
                    <img src="https://img.freepik.com/free-photo/healthy-vegetables-wooden-table_1150-38014.jpg?w=2000" class="card-img-top" alt="...">
                    <div class="card-body text-white">
                        <h4 class="card-title">San Simon village wins Best Gulayan Sa Barangay</h4>
                        <p class="card-text">SAN SIMON Barangay Santa Monica of this town was named champion in Search for Best Gulayan in Pampanga.</p>
                        <br>
                        <div class="card-footer text-center">
                            <a href="https://www.sunstar.com.ph/article/1944540/pampanga/local-news/san-simon-village-wins-best-gulayan-sa-barangay" class="btn btn-primary" target="_blank">View Article</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include "../footer/footer.php"; ?>
</body>

</html>