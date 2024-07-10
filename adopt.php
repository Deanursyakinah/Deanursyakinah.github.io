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

session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo "<script>alert('Anda harus login terlebih dahulu'); window.location.href = 'signin2.php';</script>";
        exit;
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
                            class="btn nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">LOG OUT</button>
                    </form>
                <?php } else { ?>
                    <a href="signin2.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">LOGIN
                        <i class="bi bi-arrow-right"></i></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

<!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Adopt</h6>
                <h1 class="display-5 text-uppercase mb-0">Your signed up pets</h1>
            </div>
        </div>
    </div>
<!-- Products End -->

<!-- User Table Start -->
<?php
include "connectToSQL.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $sql = "SELECT * FROM adopt WHERE user_id = $user_id";
    $result = $connectToSQL->query($sql);

    if ($result->num_rows > 0):
        ?>

        <!-- User Table Start -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="padding: 20px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Species</th>
                        <th>Age</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td>
                                <?= $row["pet_name"] ?>
                            </td>
                            <td>
                                <?= $row["category"] ?>
                            </td>
                            <td>
                                <?= $row["species"] ?>
                            </td>
                            <td>
                                <?= $row["age"] ?>
                            </td>
                            <td>
                                <?= $row["description"] ?>
                            </td>
                            <td>
                                <?= $row["price"] ?>
                            </td>
                            <td><img src="data:image/jpeg;base64,<?= base64_encode($row['pet_pic']) ?>" height="100px"
                                    width="auto" /></td>
                            <td>
                                <?= $row["status"] ?>
                            </td>
                            <td>
                                <?php if ($row["status"] == "In negotiations"): ?>
                                    <button class="btn btn-success py-2 px-3"
                                        onclick="confirmAdoption(<?= $row['pet_id'] ?>, '<?= $row['pet_name'] ?>')"><i
                                            class="bi bi-check"></i></button>
                                    <button class="btn btn-danger py-2 px-3"
                                        onclick="denyAdoption(<?= $row['pet_id'] ?>, '<?= $row['pet_name'] ?>')"><i
                                            class="bi bi-x"></i></button>
                                <?php endif; ?>
                                <button class="btn btn-danger py-2 px-3"
                                    onclick="deletePet(<?= $row['pet_id'] ?>, '<?= $row['pet_name'] ?>')"><i
                                        class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        <!-- User Table End -->

        <?php
    else:
        ?>
        <div class="alert alert-warning" role="alert">
            You have not signed up any pets yet.
        </div>
        <?php
    endif;
?>
    <!-- User Table End -->

    <div class="container-fluid py-5">
        <div class="container">
            <a class="btn btn-primary py-2 px-3" href="addadopt.php">Sign Up Your Pet For Adoption</a>
        </div>

        <!-- Products Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                    <h6 class="text-primary text-uppercase">Adopt</h6>
                    <h1 class="display-5 text-uppercase mb-0">Adopt a New Pet Today</h1>
                </div>
            </div>
        </div>
        <!-- Products End -->


<!-- Table Start -->
<div class="table-responsive">
    <table class="table table-striped table-bordered" style="padding: 20px;">
        <thead>
            <tr>
                <th>Owner</th>
                <th>Category</th>
                <th>Species</th>
                <th>Age</th>
                <th>Description</th>
                <th>Price</th>
                <th>Picture</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "connectToSQL.php";

            $sql = "SELECT a.*, u.username as user_name FROM adopt a INNER JOIN user u ON a.user_id = u.user_id WHERE a.user_id != $user_id";
            $result = $connectToSQL->query($sql);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td>
                            <?= $row["user_name"] ?>
                        </td>
                        <td>
                            <?= $row["category"] ?>
                        </td>
                        <td>
                            <?= $row["species"] ?>
                        </td>
                        <td>
                            <?= $row["age"] ?>
                        </td>
                        <td>
                            <?= $row["description"] ?>
                        </td>
                        <td>
                            <?= $row["price"] ?>
                        </td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($row['pet_pic']) ?>" height="100px"
                                width="auto" /></td>
                        <td>
                            <?= $row["status"] ?>
                        </td>
                        <td>
                            <button class="btn btn-primary py-2 px-3"
                                onclick="adoptPet(<?= $row['pet_id'] ?>, '<?= $row['pet_name'] ?>')"><i
                                        class="bi bi-cart"></i></button>
                        </td>
                    </tr>
                    <?php
                endwhile;
            endif;
            $connectToSQL->close();

            ?>
        </tbody>
    </table>
</div>
<!-- Table End  -->


        <script>
            function adoptPet(pet_id, pet_name) {
                var confirmed = confirm("Are you sure you want to adopt " + pet_name + "? Make sure you already contacted the owner if you want to adopt them");
                if (confirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "updatePetStatus.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            location.reload();
                        }
                    }
                    xhr.send("pet_id=" + pet_id + "&status=In negotiations");
                    alert("You have confirmed your adoption for " + pet_name + ", we have contacted the owner to inform you for further informations");
                }
            }

            function deletePet(petId, petName) {
                if (confirm("Are you sure you want to delete " + petName + "?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "deletePet.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            window.location.reload();
                        }
                    };
                    xhr.send("pet_id=" + petId);
                }
            }

            function denyAdoption(pet_id, pet_name) {
                if (confirm(`Are you sure you want to deny adoption for ${pet_name}?`)) {
                    $.ajax({
                        url: "denyAdoption.php",
                        type: "POST",
                        data: {
                            pet_id: pet_id
                        },
                        success: function () {
                            location.reload();
                        }
                    });
                }
            }

            function confirmAdoption(petId, petName) {
                if (confirm("Are you going to confirm the adoption of " + petName + "?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "deletePet.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            window.location.reload();
                        }
                    };
                    xhr.send("pet_id=" + petId);
                }
            }

        </script>

        <!-- <script>
            function adoptPet(pet_id, pet_name) {
                var confirmed = confirm("Are you sure you want to adopt " + pet_name + "? Make sure you already contacted the owner if you want to adopt them");
                if (confirmed) {
                    // Send AJAX request to delete the selected pet from the SQL table
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "deletePet.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Reload the page to show the updated list of pets
                            location.reload();
                        }
                    }
                    xhr.send("pet_id=" + pet_id);
                    alert("You have confirmed your adoption for " + pet_name + ", we have contacted the owner to inform you for further informations");
                }
            }
        </script> -->



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