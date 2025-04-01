<?php
if (isset($_SESSION['login']) and $config['web']['maintenance'] == 1) {
    exit("<center><h1>SORRY, WEBSITE IS UNDER MAINTENANCE!</h1></center>");
}
require 'lib/is_login.php';
require 'lib/csrf_token.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $config['web']['short_title'] ?> adalah sebuah website penyedia layanan sosial media terlengkap, termurah, dan berkualitas." />
    <meta name="keywords" content="smm panel, MedanPedia, pusat smm panel indonesia, smm panel indonesia, panel smm terbaik, smm panel pusat, smm panel, smm indonesia, smm panel reseller, smm panel Terbaik Di Indonesia, smm panel Termurah Di Indonesia, Smm Layanan termurah, panel smm termurah, panel instagram termurah,panel termurah di indonesia, smm panel terbaik, smm medan, smm panel indo, pusat Panel, reseller panel,panel instagram, best smm world, panel smm terbaik indonesia, jasa kebutuhan sosial media, sewasmm, sewa smm, auto followers, auto likes" />
    <meta name="author" content="<?php echo $config['web']['meta']['author'] ?>" />
    <title><?php echo $config['web']['short_title'] ?> - SMM Panel indonesia</title>
    <link rel="shortcut icon" href="<?php echo $config['web']['base_url'] ?>landing/assets/img/naspanel-logo.png">
    <link href="<?php echo $config['web']['base_url'] ?>landing/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['web']['base_url'] ?>landing/assets/css/icons.css" rel="stylesheet">
    <link href="<?php echo $config['web']['base_url'] ?>landing/assets/css/style.css" rel="stylesheet">
    <style type="text/css">
        .navbar-custom {
            background-color: #2c8ef8 !important;
        }

        .btn-custom {
            background-color: #2c8ef8 !important;
        }

        .text-tran-box {
            background: #2c8ef8;
            background: -webkit-linear-gradient(to left, #2c8ef8, #000);
            background: linear-gradient(to left, #2c8ef8, #000);
        }
    </style>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .overlay {
            width: 100%;
            height: 550px;
            background:
                linear-gradient(rgba(13, 110, 255, 0.7),
                    rgb(148, 0, 211, 0.5)),
                url(landing/assets/img/smmbaru.webp) no-repeat;
            background-size: cover;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-default navbar-light navbar-custom sticky" style="background: #02c0ce;">
        <div class="container">
            <a class="navbar-brand logo text-white" href="/">
                <?php echo $config['web']['short_title'] ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="nav navbar-nav ml-auto navbar-center" id="mySidenav">
                    <li class="nav-item">
                        <a href="#home" class="nav-link scroll" style="color: #fff !important">Utama</a>
                    </li>
                    <li class="nav-item">
                        <a href="#features" class="nav-link scroll" style="color: #fff !important">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link scroll" style="color: #fff !important">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $config['web']['base_url'] ?>price_list/" class="nav-link" style="color: #fff !important">Daftar Harga</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $config['web']['base_url'] ?>auth/login" class="nav-link" style="color: #fff !important">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $config['web']['base_url'] ?>auth/register" class="nav-link" style="color: #fff !important">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $config['web']['base_url'] ?>page/site/Sewa-smm" class="nav-link" style="color: #fff !important">Sewa SMM</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>