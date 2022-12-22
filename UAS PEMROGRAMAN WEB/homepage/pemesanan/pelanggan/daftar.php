<?php

$update = ((isset($_GET['action']) AND $_GET['action'] == 'update') OR isset($_SESSION["pelanggan"])) ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_SESSION[pelanggan][id]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pelanggan SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', no_telp='$_POST[no_telp]', alamat='$_POST[alamat]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_pelanggan='$_SESSION[pelanggan][id]'";
	} else {
		$sql = "INSERT INTO pelanggan VALUES (NULL, '$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[no_telp]', '$_POST[alamat]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil! Silahkan login", "login.php");
  } else {
		echo alert("Gagal!", "?page=pelanggan");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_SESSION[pelanggan][id]'");
	echo alert("Berhasil!", "?page=pelanggan");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEPEDA</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <style type="text/css">
    	body{
    		background-color: #f4decb; font-family: 'Poppins', sans-serif;
    	}
    	.container .card{
    		background-color: #94618e; 
    		box-shadow: -4px 4px 12px 0 #49274a;
			margin-bottom: 2.2rem;
			border-radius: 2px;
			margin-top: 20px;
			padding: 20px;
		}

    	.container h2{
    		color: white;
    	}
    	.container h2 small{
    		color: white;
    	}
    	.container label{
    		color: white
    	}
    	.form-group > input{
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			outline:  none;
			background: #f4decb;
			padding: 0.5rem 0.7rem;
			font-size: 1.2rem;
			font-family: 'poppins', sans-serif;
    	}
    	.card .form-group{
    		content: '';
		    margin: 10px 0;
		    padding: 5px 0;
		}
		input, textarea:hover, input:hover, textarea:active, input:active, input:focus, button:focus, button:focus, textarea:focus, button:active, button:hover, label:focus{
			outline: 0px !important;
			border-radius: 2px;
			-webkit-appearance:none;
			box-shadow: none !important;
			border: 2px solid white !important;
			color: #49274a !important;
		}
		.btn{
			display: block;
			width: 100%;
			height: 50px;
			border-radius: 25px;
			outline: none;
			border: none;
			background-image: linear-gradient(to right, #49274a, #49274a, #49274a);
			background-size: 200%;
			font-size: 1.2rem;
			color: #fff;
			font-family: 'Poppins', sans-serif;
			text-transform: uppercase;
			margin: 1rem 0;
			cursor: pointer;
			transition: .5s;
		}
		.btn:hover{
			background-image: linear-gradient(to right, #49274a, #94618e, #49274a);
			background-position: center;
			color: white;
		}

    </style>
</head>
<body >
	<div class="container" style=" margin-bottom: 20px;">
			<div class="col-md-2"></div>
			<div class="card col-md-8">
				<div class="page-header">
					<?php if ($update): ?>
						<h2>Update <small>data pelanggan!</small></h2>
					<?php else: ?>
						<h2>Daftar <small>sebagai pelanggan!</small></h2>
					<?php endif; ?>
				</div>
				<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" class="form-control" required="" autofocus="on" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
					</div>
					<div class="form-group">
						<label for="no_ktp">No KTP</label>
						<input type="text" name="no_ktp" required="" class="form-control" <?= (!$update) ?: 'value="'.$row["no_ktp"].'"' ?>>
					</div>
					<div class="form-group">
						<label for="no_telp">No Telp</label>
						<input type="text" name="no_telp" required="" class="form-control" <?= (!$update) ?: 'value="'.$row["no_telp"].'"' ?>>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" required="" class="form-control" <?= (!$update) ? "" : $row["alamat"] ?>>
					</div>
					<div class="form-group">
						<label for="email">email</label>
						<input type="email" name="email" required="" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" required="" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					<?php if ($update): ?>
						<div class="row">
								<div class="col-md-10">
									<button type="submit" class="btn btn-warning btn-block">Update</button>
								</div>
								<div class="col-md-2">
									<a href="?page=kriteria" class="btn btn-default btn-block">Batal</a>
								</div>
						</div>
					<?php else: ?>
						<button type="submit" class="btn">Register</button>
					<?php endif; ?>
					<br><br>
			</form>
			</div>
			<div class="col-md-2"></div>
	</div>
</body>
</html>