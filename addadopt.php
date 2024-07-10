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
    <?php
    include "connectToSQL.php";
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location: signin2.php");
        exit;
    }

    if (isset($user_id) && isset($_POST['petname']) && isset($_POST['category']) && isset($_POST['species']) && isset($_POST['age']) && isset($_POST['desc']) && isset($_POST['price']) && isset($_FILES['petpic'])) {
        $petname = $_POST['petname'];
        $category = $_POST['category'];
        $species = $_POST['species'];
        $age = $_POST['age'];
        $description = $_POST['desc'];
        $price = $_POST['price'];
        // $pet_pic = $_FILES['petpic']['tmp_name'];
        $pet_pic = addslashes(file_get_contents($_FILES['petpic']['tmp_name']));

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO adopt (user_id, pet_name, category, species, age, description, price, pet_pic, status) VALUES ('$user_id', '$petname', '$category', '$species', '$age', '$description', '$price', '$pet_pic', 'Available')";
        if (mysqli_query($connectToSQL, $sql)) {
            // exit;
            header("Location: adopt.php");
            // echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connectToSQL);
        }       
    }
    // mysqli_stmt_close($stmt);
    mysqli_close($connectToSQL);
    ?>

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


    <!-- SIgn Up Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Adoption</h6>
            <h1 class="display-5 text-uppercase mb-0">Sign Up Your Pet For Adoption</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <form method="POST" enctype='multipart/form-data'>
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" name="petname" class="form-control bg-light border-0 px-4"
                                    placeholder="Name" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="category" class="form-control bg-light border-0 px-4"
                                    placeholder="Category" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="species" class="form-control bg-light border-0 px-4"
                                    placeholder="Species" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="age" class="form-control bg-light border-0 px-4"
                                    placeholder="Age" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="desc" class="form-control bg-light border-0 px-4"
                                    placeholder="Description ur pet and drop ur contact" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" name="price" class="form-control bg-light border-0 px-4"
                                    placeholder="Price" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="file" name="petpic" class="form-control bg-light border-0 px-4"
                                    placeholder="Pet Picture" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Sign Up Pet For
                                    Adoption</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SIgn Up End -->

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
    <script src="js/main.js"></script>
</body>

</html>