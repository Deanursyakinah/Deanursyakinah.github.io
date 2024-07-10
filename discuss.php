<html lang="en">

<?php

session_start();

if (isset($_POST['submit'])) {
    session_unset();
    session_destroy();
    setcookie("profpict", "", 1, "");
    setcookie("username", "", 1, "");
    header('Location: signin2.php');
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: signin2.php");
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

    <style>
        .button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: 25px;
        }

        .button-danger {
            background-color: #f44336;
        }

        .button-success {
            background-color: #4CAF50;
        }

        .button-separator {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
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
                        <i class="bi bi-arrow-left"></i></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Form -->
    <h1></h1>
    <h3></h3>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h5 class="text-primary text-uppercase">Discusion Forum</h5>
                <h1 class="display-5 text-uppercase mb-0">Want add a new discussion Forum?</h1>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <form method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="topic">Discussion Title :</label><br>
                                    <input type="text" name="topic" id="topic" class="form-control bg-light border-0 px-4" placeholder="Add Title Here" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <label for="description">Description:</label><br>
                                    <textarea type="text" name="description" id="descriptiom" class="form-control bg-light border-0 px-4" placeholder="Add your question or opinion here...." style="height: 150px;"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Add Discussion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form End -->

    <?php
    include "connectToSQL.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topic = $_POST["topic"];
        $description = $_POST["description"];
        $sql = "INSERT INTO discuss (user_id, topic, description)
            VALUES ('$user_id','$topic', '$description')";

        if (mysqli_query($connectToSQL, $sql)) {
            echo "<br> Data berhasil dimasukan!";

            $query = "SELECT * FROM discuss";
            $get = mysqli_query($connectToSQL, $query);

            if ($get) {
                $data = "<discussion>";
                while ($row = mysqli_fetch_array($get)) {
                    $discuss_id = "<discuss_id>{$row['discuss_id']}</discuss_id>";
                    $user_id = "<user_id>{$row['user_id']}</user_id>";
                    $topic = "<topic>{$row['topic']}</topic>";
                    $description = "<description>{$row['description']}</description>";

                    $data .= "<discuss>" . $discuss_id . $user_id . $topic . $description .  "</discuss>";
                }
                $data .= "</discussion>";

                $x = new SimpleXMLElement($data);

                $x->asXML("discuss.xml");
            } else {
                echo "Error : " . mysqli_error($connectToSQL);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connectToSQL);
        }
    }

    $sql = "SELECT * FROM discuss";
    $result = mysqli_query($connectToSQL, $sql);


    echo "<h1 style='color: green; margin-left: 25;'> Discussion Room :</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        $queryGetName = "SELECT * FROM user WHERE user_id = '{$row['user_id']}'";
        $sql = mysqli_query($connectToSQL, $queryGetName);
        $data = mysqli_fetch_assoc($sql);
        echo "<h2 style='margin-left: 25px;'>" . $row["topic"] . "</h2>";
        echo "<div style=' margin-left:25px; display: flex; align-items:center;'><img style='width:50px; height:50px; border-radius:50%;' src='imgSignUp/{$data['profpict']}' alt=''><h5>" ." by " . "{$data['username']}</h5></div>";
        echo "<p style='margin-left: 25px; margin-top: 10px;'>" . $row["description"] . "</p>";
        echo "<a href='repplycomment.php?id={$row['discuss_id']}&username={$data['username']}'><button class='button'>Join Room</button></a>";
        if ($_SESSION['user_id'] == $row['user_id']) {
            echo "<a href='deletediscuss.php?id={$row['discuss_id']}'><button class='button button-danger'>Delete</button></a><a href='editdiscuss.php?id={$row['discuss_id']}'><button class='button button-success'>Edit</button></a>";
        }

        echo "<hr style='margin-top: 25; margin-left: 25;'>";
    }


    mysqli_close($connectToSQL);
    ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="index.php"><i class="bi bi-arrow-left text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="blog.php"><i class="bi bi-arrow-left text-primary me-2"></i>Article</a>
                        <a class="text-body mb-2" href="infoPet.php"><i class="bi bi-arrow-left text-primary me-2"></i>Info Pet</a>
                        <a class="text-body mb-2" href="discuss.php"><i class="bi bi-arrow-left text-primary me-2"></i>Discussion</a>
                        <a class="text-body mb-2" href="adopt.php"><i class="bi bi-arrow-left text-primary me-2"></i>Adopt</a>
                        <!-- <a class="text-body" href="#"><i class="bi bi-arrow-left text-primary me-2"></i></a> -->
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
</body>

</html>