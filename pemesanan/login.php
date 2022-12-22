<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "controller.php";
    $sql = "SELECT * FROM pelanggan WHERE username='$_POST[username]' AND password='" . md5($_POST['password']) . "'";
    if ($query = $connection->query($sql)) {
        if ($query->num_rows) {
            session_start();
            while ($data = $query->fetch_array()) {
                $_SESSION["pelanggan"]["is_logged"] = true;
                $_SESSION["pelanggan"]["id"] = $data["id_pelanggan"];
                $_SESSION["pelanggan"]["username"] = $data["username"];
                $_SESSION["pelanggan"]["nama"] = $data["nama"];
                $_SESSION["pelanggan"]["no_ktp"] = $data["no_ktp"];
                $_SESSION["pelanggan"]["no_telp"] = $data["no_telp"];
                $_SESSION["pelanggan"]["email"] = $data["email"];
                $_SESSION["pelanggan"]["alamat"] = $data["alamat"];
              }
            header('location: index.php');
        } else {
            echo alert("Username / Password tidak sesuai!", "login.php");
        }
    } else {
        echo "Query error!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEPEDA</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="assets/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="assets/img/bgbaru.png">
        </div>
        <div class="login-content">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                <img src="assets/img/avatar.png">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <label for="username"><h5></h5></label>
                        <input type="text" name="username" class="input" id="username" placeholder="username" autofocus="on">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <label for="password"><h5></h5></label>
                         <input type="password" name="password" class="input" id="password" placeholder="Password">
                   </div>
                </div>
                <input type="submit" class="btn" value="Login">
                <br>
                <div class="panel-footer">
                    Belum punya akun? <a href="index.php?page=daftar"> daftar sekarang.</a>
                </div>
            </form>      
        </div>
    </div>
    <script type="text/javascript" src="assetsjs/main.js"></script>
</body>
</html>
