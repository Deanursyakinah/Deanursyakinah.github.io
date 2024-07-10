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
                    <span class="username">
                        <?php echo $_COOKIE['username']; ?>
                    </span>
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
                        <button type="submit" name="submit"
                            class="btn nav-link nav-contact bg-primary text-white px-5 ms-lg-5">LOG OUT</button>
                    </form>
                <?php } else { ?>
                    <a href="signin2.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">SIGN IN
                        <i class="bi bi-arrow-right"></i></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Info Pet</h6>
                <h1 class="display-5 text-uppercase mb-0">What pet do you prefer?</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
                <!-- <a class='btn btn-light btn-square mx-1' href='#'><i class='bi bi-instagram'></i></a> -->
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
    <!-- Team End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="index.html"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="newArticle.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Article</a>
                        <a class="text-body mb-2" href="infoPet.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Info Pet</a>
                        <a class="text-body mb-2" href="discuss.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Discussion</a>
                        <a class="text-body mb-2" href="addadopt.php"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Adopt</a>
                        <!-- <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="index.html">PET LOVERS</a>. All Rights
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
            for (i = 0; i < x.length; i++) {
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