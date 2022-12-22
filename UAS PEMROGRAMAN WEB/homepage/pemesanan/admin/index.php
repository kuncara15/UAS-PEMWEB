<?php
session_start();
require_once "../controller.php";
if (!isset($_SESSION["admin"])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sepeda</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <!-- Optional, Add fancyBox for media, buttons, thumbs -->
    <link rel="stylesheet" href="../assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../assets/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../assets/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/ead44325cb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="../assets/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script><!-- Optional, Add mousewheel effect -->
    <script type="text/javascript" src="../assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <style>
      *{
        font-family: 'Poppins', sans-serif;
      }
        body {
            margin-top: 40px;
            background-color: #F4DECB;
        }
        .navbar {
          background-color: #94618E;
        }
        .navbar a {
          color: #F8EEE7;
        }
        .navbar a:hover{
          color: #49274A;
        }
        img {
          width: 100%;
          max-width: 100%;
          height: auto;
        }
        .admin h1 {
          position: absolute;
          color: #49274A; 
        }
        .panel .panel-heading{
          background-color:#F8EEE7;
        }
        .panel-footer {
          background-color: #F8EEE7;
        }
        .simpan{
          -webkit-animation: glowing 1300ms infinite;
          -moz-animation: glowing 1300ms infinite;
          -o-animation: glowing 1300ms infinite;
          animation: glowing 1300ms infinite;
        }
        @-webkit-keyframes glowing {
          0% { background-color: #49274A; -webkit-box-shadow: 0 0 3px #49274A; }
          50% { background-color: #94618E; -webkit-box-shadow: 0 0 10px #94618E; }
          100% { background-color: #49274A; -webkit-box-shadow: 0 0 3px #49274A; }
        }
        @keyframes glowing {
          0% { background-color: #49274A; box-shadow: 0 0 3px #49274A; }
          50% { background-color: #94618E; box-shadow: 0 0 10px #94618E; }
          100% { background-color: #49274A; box-shadow: 0 0 3px #49274A; }
        }

        .btn {
          background-color: #49274A;
          color: #F8EEE7;
        }
        .simpan:hover {
          color: #F8EEE7;
        }
        .text-center {
          color: #49274A;
        }
        .btn:hover, .glyphicon {
          background-color: #94618E;
        }
        .navbar-toggle {
          border-color: #F8EEE7;
        }
    </style>
</head>
<body>

    <div class="container">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle glyphicon glyphicon-menu-hamburger">
                <span class="sr-only">Toggle navigation</span>
            </button>
                    <a class="navbar-brand" href="../../../index.php">ADMIN | GOWES</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=home">Beranda <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Input <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="?page=admin">Admin</a></li>
                            <li><a href="?page=jenis">Jenis</a></li>
                            <li><a href="?page=sepeda">Sepeda</a></li>
                            <li><a href="?page=pelanggan">Pelanggan</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="?page=lap_konfirmasi">Konfirmasi</a></li>
                            <li><a href="?page=lap_sepeda">Penyewaan Sepeda</a></li>
                            <li><a href="?page=lap_denda">Laporan Denda</a></li>
                          </ul>
                        </li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="#">|</a></li>
                        <li><a href="#" style="font-weight: bold; color: pink;"><?= ucfirst($_SESSION["admin"]["username"]) ?></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="row">
            <div class="col-md-12">
              <?php include adminPage($_ADMINPAGE); ?>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>