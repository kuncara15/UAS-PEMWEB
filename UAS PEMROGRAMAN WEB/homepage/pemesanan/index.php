<?php
ob_start();
session_start();
require_once "controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEPEDA</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
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
        h2 {
            color: #49274A;
        }
        .btn {
          background-color: #49274A;
          color: #F8EEE7;
          border-color: none;
        }
        .simpan:hover {
          color: #F8EEE7;
        }
        .text-center {
          color: #49274A;
        }
        .btn:hover, .glyphicon {
          background-color: #94618E;
          color: pink;
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
                    <a class="navbar-brand" href="../../index.php">GOWES</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=home">Beranda <span class="sr-only">(current)</span></a></li>
                        <?php if (isset($_SESSION["pelanggan"])): ?>
                          <li><a href="?page=profil">Profil</a></li>
                          <li><a href="logout.php">Logout</a></li>
                          <li><a href="#">|</a></li>
                          <li><a href="#" style="font-weight: bold; color: pink;"><?= ucfirst($_SESSION["pelanggan"]["username"]) ?></a></li>
                        <?php else: ?>
                          <li><a href="?page=daftar">Daftar</a></li>
                          <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-12">
              <?php include page($_PAGE); ?>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
