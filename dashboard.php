<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'views/header.php';?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .carousel-caption {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        padding: 10px;
        color: white;
        text-align: center;
    }

    /* Style untuk teks judul pada caption */
    .carousel-caption h5 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    /* Style untuk teks deskripsi pada caption */
    .carousel-caption p {
        font-size: 14px;
        margin-bottom: 0;
    }


    h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .header h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .method {
        background-color: #f7f7f7;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .method h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <h2>Selamat Datang di Dashboad Pegawai</h2>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/image/gambar 1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <p>Perusahaan Intel</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/image/gambar 2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <p>Logo Intel</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/image/gambar 3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <p>Manufaktur Intel</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-7v3A54srKp7wl0rwnEs5oXwLcy2JcyOe33Iht9wv0J0Pe2d+Vn0a+/RufCq1dj2b" crossorigin="anonymous">
    </script>


    <?php
// method untuk menghitung total book
function getTotalPegawai() {
    $connect = new PDO("mysql:host=localhost; dbname=oopphp", "root", "");
    $query = "SELECT COUNT(*) as total_pegawai FROM pegawai";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result[0]['total_pegawai'];
}

// method untuk menghitung total users
function getTotalUsers() {
    $connect = new PDO("mysql:host=localhost; dbname=oopphp", "root", "");
    $query = "SELECT COUNT(*) as total_users FROM users";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result[0]['total_users'];
}
?>

    <div class="header">
        <h1>Statistics</h1>
    </div>

    <div class="method">
        <h2>Total Pegawai</h2>
        <p><?php echo getTotalPegawai(); ?></p>
    </div>

    <div class="method">
        <h2>Total Users</h2>
        <p><?php echo getTotalUsers(); ?></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var myCarousel = document.querySelector('#carouselExample');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000,
            wrap: true
        });
    });
    </script>

    <?php include 'views/footer.php';?>