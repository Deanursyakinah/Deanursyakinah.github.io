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
        echo "<script>alert('Anda harus login terlebih dahulu'); window.location.href = 'signin2.php';</script>";
        exit;
    }
    if (isset($user_id) && isset($_POST['article_topic']) && isset($_POST['article_title']) && isset($_POST['new_article']) && isset($_FILES['article_pic'])) {
        if (isset($_POST['other-topic'])) {
            $topic = $_POST['other-topic'];
        } else {
            $topic = $_POST['article_topic'];
        }
        $title = $_POST['article_title'];
        $newArticle = $_POST['new_article'];
        $article_pic = basename($_FILES['article_pic']['name']); // ambil nama file dari $_FILES['article_pic']
        $tmp_pict = $_FILES['article_pic']['tmp_name'];

        move_uploaded_file($tmp_pict, "postArticle/imgArticle/" . $article_pic);

        // Cek apakah judul artikel sudah ada di database
        $sql = "SELECT * FROM article WHERE article_title = '$title'";
        $result = mysqli_query($connectToSQL, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Judul artikel sudah digunakan oleh user lain.";
        } else {
            $publishDate = date('Ymd');
            $folder = "postArticle/fileArticle/";
            $filename = $user_id . '_' . $publishDate . "_" . str_replace(' ', '_', $title);
            $target_file = $folder . $filename . ".txt";
            $file = fopen($target_file, "w");
            fwrite($file, $newArticle);
            fclose($file);


            if (file_exists($target_file)) {
                $sql = "INSERT INTO article (user_id, article_topic, article_title, publish_date, article_pic, article_filename) VALUES ('$user_id', '$topic', '$title', '$publishDate', '$article_pic', '$filename')";
                if (mysqli_query($connectToSQL, $sql)) {
                    echo "<script>alert('Artikel Anda berhasil dipublish'); window.location.href = 'blog.php?info=';</script>";
                } else {
                    echo ("There something wrong: " . mysqli_error($connectToSQL));
                }
            } else {
                echo "There was an error uploading your file.";
            }
        }

    }
    ?>
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


    <!-- New Article Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">New Post</h6>
                <h1 class="display-5 text-uppercase mb-0">Drop Your Article Now</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <?php if (isset($error)): ?>
                        <div style="color:red;">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form action="newArticle.php" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <select onchange="gantiValue()" name="article_topic"
                                    class="form-control bg-light border-0">
                                    <option value="Choose Your Topic">Choose Your Topic</option>
                                    <option value="Pet Health Care">Pet Health Care</option>
                                    <option value="Pet Exercise & Play">Pet Exercise & Play</option>
                                    <option value="Pet First Aid & Emergency Case">Pet First Aid & Emergency Case
                                    </option>
                                    <option value="Pet Nutrition & Diet">Pet Nutrition & Diet</option>
                                    <option value="Pet Fun Facts">Pet Fun Facts</option>
                                    <option value="Pet Events">Pet Events</option>
                                    <option value="7">Other</option>
                                </select>
                                <div id="other"></div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control bg-light border-0" name="article_title"
                                    placeholder="Your Article Title" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-light border-0 px-4 py-3" name="new_article" rows="8"
                                    placeholder="Type Your Article" required></textarea>
                            </div>
                            <div class="col-12">
                                <input type="file" accept="image/*" name="article_pic"
                                    class="form-control bg-light border-0 px-4" required />
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- New Article End -->


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
    <script>
        function gantiValue() {
            var selectedValue = document.querySelector('select[name="article_topic"]').value;
            if (selectedValue == '7') {
                document.getElementById("other").innerHTML = `<div class="col-12 col-sm-6" style="margin-top:5px"><input type="text" name="other-topic" id="other-topic" class="form-control bg-light border-0" placeholder="Other topic"></div>`
            } else {
                document.getElementById("other").innerHTML = ""
            }
        }
    </script>
</body>

</html>