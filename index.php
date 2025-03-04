<!DOCTYPE html>
<html lang="en">
    
<?php
if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    setcookie("profpict", "", 1, "");
    setcookie("username", "", 1, "");
    header('Location: signin2.php');
}
?>
<head>
    <meta charset="utf-8">
    <title>PET LOVERS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.php" class="navbar-brand ms-lg-5">
            <div>
                <?php if (isset($_COOKIE['username'])) { ?>
                    <img class="profile-pic" src="imgSignUp/<?php echo $_COOKIE['profpict']; ?>" alt="Profile Picture">
                    <span class="username"><?php echo $_COOKIE['username']; ?></span>
                <?php } ?>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="blog.php" class="nav-item nav-link">Article</a>
                <a href="infoPet.php" class="nav-item nav-link">Info Pet</a>
                <a href="discuss.php" class="nav-item nav-link">Discussion</a>
                <a href="adopt.php" class="nav-item nav-link">Adopt</a>
                <?php if (isset($_COOKIE['username'])) { ?>
                    <form action="" method="post">
                        <button type="submit" name="submit" class="btn nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">LOG OUT</button>
                    </form>
                <?php } else { ?>
                <a href="signin2.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">LOGIN
                    <i class="bi bi-arrow-right"></i></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Info Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-uppercase text-dark mb-lg-4">Pet lovers</h1>
                    <h1 class="text-uppercase text-white mb-lg-4">Make Your Pets Happy</h1>
                    <!-- <p class="fs-4 text-white mb-lg-4">Dolore tempor clita lorem rebum kasd eirmod dolore diam eos kasd.
                        Kasd clita ea justo est sed kasd erat clita sea</p> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Info End -->

    <!-- Article Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="img/about.jpg"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h6 class="text-primary text-uppercase">Article</h6>
                        <h1 class="display-5 text-uppercase mb-0">We Keep Our Pets Happy All Time</h1>
                    </div>
                    <h4 class="text-body mb-4">People who love pets usually feel happier, calmer and healthier because of the positive relationship they build with their pets. However, we must be prepared and responsible in caring for our pets so that the relationship can work well and provide positive benefits to our health and well-being. </h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Article End -->

    <!-- Discussion Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Discussion</h6>
                <h1 class="display-5 text-uppercase mb-0">Pet Lover's Discuss</h1>
            </div>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
                        <i class="flaticon-dog display-1 text-primary me-4"></i>
                        <div>
                            <h5 class="text-uppercase mb-3">User can discuss and talk with another user</h5>
                            <p></p>
                            <a class="text-primary text-uppercase" href="discuss.php">Let's see<i
                                    class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Discussion End -->


    <!-- Info pet Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Info Pet</h6>
                <h1 class="display-5 text-uppercase mb-0">What pet do you prefer?</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
                <?php
                $xml = simplexml_load_file("infoPet.xml");

                foreach ($xml->pet as $pet) {
                    echo "
                        <div class='team-item'>
                        <div class='position-relative overflow-hidden'>
                            <img class='img-fluid w-80' src='$pet->image' alt=''>
                            <div class='team-overlay'>
                                <div class='d-flex align-items-center justify-content-start'>
                                <p onclick='clickHandler(\"" . $pet->type . "\")' class='text-uppercase' style='color:white;'>Read More<i
                                            class='bi bi-chevron-right'></i></p>
                                </div>
                            </div>
                        </div>
                        <div class='bg-light text-center p-4'>
                            <h5 class='text-uppercase'>{$pet->name}</h5>
                            <p class='m-0'>{$pet->type}</p>
                        </div>
                    </div>
                        ";
                }
                ?>
            </div>
            <div id="data-pet"></div>
        </div>
    </div>
    <!-- Info End -->


    <!-- Masih adopt Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-start">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-dark ps-5 mb-5">
                        <h6 class="text-dark text-uppercase">Let's Adopt</h6>
                        <h1 class="display-5 text-uppercase text-white mb-0">Wanna Adopt The Pets?</h1>
                    </div>
                    <p class="text-white mb-4">Click the button to adopt the cutie and lovely pets ❤️ </p>
                        <a href="addadopt.php" class="btn btn-light py-md-3 px-md-5 me-3">Adopt Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Masih adopt End -->


    <!-- Adopt Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Adopter-Preview</h6>
                <h1 class="display-5 text-uppercase mb-0">Adopt a pet to make you feel happy</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
            <?php 
                $xml = simplexml_load_file("adopt.xml");

                foreach ($xml->adopter as $adopt) {
                    echo "
                <div class='team-item'>
                    <div class='position-relative overflow-hidden'>
                        <img class='img-fluid w-100' src='{$adopt->image}' alt=''>
                    </div>
                    <div class='bg-light text-center p-4'>
                        <h5 class='text-uppercase'>{$adopt->nameAdopter}</h5>
                        <p class='m-0'>{$adopt->namePet}</p>
                    </div>
                </div>
                    ";
                }
            ?>
            </div>
        </div>
    </div>
    <!-- Adopt End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="index.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="blog.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Article</a>
                        <a class="text-body mb-2" href="infoPet.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Info Pet</a>
                        <a class="text-body mb-2" href="discuss.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Discussion</a>
                        <a class="text-body mb-2" href="adopt.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Adopt</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="index.php">PET LOVERS</a>. All Rights
                        Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script>
        function clickHandler(typePet) {
            var xmlhttp = new XMLHttpRequest(); //get file xml, kyk simplexml_load_file mirip
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    xmlHandler(this, typePet); //this -> var xmlhttp
                }
            };
            xmlhttp.open("GET", "infoPet.xml", true);
            xmlhttp.send();
        }

        function xmlHandler(xml, typePet) { //xml -> file, typePet -> line 75
            let xmlDoc = xml.responseXML;
            let x = xmlDoc.getElementsByTagName("pet"); //tag sub-root
            for (i = 0; i <script x.length; i++) {
                let y = xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                if (typePet == y) {
                    let pathImg = xmlDoc.getElementsByTagName("image")[i].childNodes[0].nodeValue;
                    let petImage = `<img src='${pathImg}' alt='' />`;
                    let petName = "<strong>Nama binatang: </strong>" + xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
                    let petWeight = "<strong>Berat: </strong>" + xmlDoc.getElementsByTagName("weight")[i].childNodes[0].nodeValue;
                    let petType = "<strong>Tipe: </strong>" + xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                    let petHeight = "<strong>Tinggi: </strong>" + xmlDoc.getElementsByTagName("height")[i].childNodes[0].nodeValue;
                    let petFoods = "<strong>Makanan: </strong>" + xmlDoc.getElementsByTagName("foods")[i].childNodes[0].nodeValue;
                    let petColor = "<strong>Warna: </strong>" + xmlDoc.getElementsByTagName("color")[i].childNodes[0].nodeValue;
                    let petHabits = "<strong>Kebiasaan: </strong>" + xmlDoc.getElementsByTagName("habits")[i].childNodes[0].nodeValue;
                    document.getElementById("data-pet").innerHTML = petImage + "<br />" + petName + "<br />"  + petType + "<br />" + petWeight + "<br />" + petHeight + "<br />" + petFoods+ "<br />" + petColor + "<br />" + petHabits; //write
                }
            }

        }
    </script>
    <script src="js/main.js"></script>
</body>
</html>