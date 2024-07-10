<!DOCTYPE html>
<html lang="en">

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
<!-- Navbar End -->

<body>
    <!-- INI SIGN IN -->
    <?php
    session_start(); 
    include "connectToSQL.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //check kalau user udah ada dan pw nya bener
        $query = "SELECT * FROM user WHERE username = '$username';";
        $result = mysqli_query($connectToSQL, $query);

        // if the query returns a row, the user is authenticated
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['user_id'] = $row['user_id']; // store the user ID in a session variable
            setcookie('username', $row['username'], time() + (3600 * 5), "");
            setcookie('profpict', $row['profpict'], time() + (3600 * 5), "");
    
            echo "<script>alert('Login berhasil'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Username atau password salah');</script>";
        }
    }
    ?>
    <!-- SIGN IN END -->

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
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Sign In</h6>
                <h1 class="display-5 text-uppercase mb-0">Sign In To Your Account</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <!-- FORM NYA -->
                    <form method="POST" action="signin2.php">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" name="username" class="form-control bg-light border-0 px-4"
                                    placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="password" name="password" class="form-control bg-light border-0 px-4"
                                    placeholder="Password" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Sign In</button>
                            </div>
                            <p>Belum punya akun? <a href="signup2.php">klik ini</a></p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="index.html"><i
                                class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="blog.html"><i
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
    <script src="js/main.js"></script>
</body>

</html>