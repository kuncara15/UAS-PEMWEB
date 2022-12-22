<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM admin WHERE id_admin='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE admin SET nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]', telp='$_POST[telp]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_admin='$_GET[key]'";
	} else {
		$sql = "INSERT INTO admin VALUES (NULL, '$_POST[nama]', '$_POST[email]', '$_POST[alamat]', '$_POST[telp]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=admin");
  } else {
		echo alert("Gagal!", "?page=admin");
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM admin WHERE id_admin='$_GET[key]'");
	echo alert("Berhasil!", "?page=admin");
}
?>
<div class="row">
	<div class="col-md-4 hidden-print">
	    <div class="panel panel-<?= ($update)?>">
	        <div class="panel-heading"><h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3></div>
	        <div class="panel-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
	                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="telp">Telp</label>
	                    <input type="text" name="telp" class="form-control" placeholder="081111111111" <?= (!$update) ?: 'value="'.$row["telp"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="text" name="email" class="form-control" placeholder="example@email.com" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" placeholder="Surakarta" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="username">Username</label>
	                    <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="password">Password</label>
	                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda">
			                <?php if ($update): ?>
												<span class="help-block">*) Kosongkan jika tidak diubah</span>
											<?php endif; ?>
	                </div>
	                <button type="submit" class="btn btn-<?= ($update) ?> btn-block simpan">Simpan</button>
	                <?php if ($update): ?>
										<a href="?page=admin" class="btn btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="table-responsive">
	        <div class="panel">
	        <div class="panel-heading"><h3 class="text-center font-weight-bold">DAFTAR ADMIN</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed table-hover">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Nama</th>
	                        <th>Telp</th>
	                        <th>Email</th>
	                        <th>Username</th>
	                        <th>Alamat</th>
	                        <th class="hidden-print"></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM admin")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
															<td><?=$row['nama']?></td>
															<td><?=$row['telp']?></td>
															<td><?=$row['email']?></td>
															<td><?=$row['username']?></td>
															<td><?=$row['alamat']?></td>
	                            <td class="hidden-print">
	                                <div class="btn-group">
	                                    <a href="?page=admin&action=update&key=<?=$row['id_admin']?>" class="btn btn-xs">
									<span class="glyphicon glyphicon-pencil btn-xs"></span>
								</a>
	                                    <a href="?page=admin&action=delete&key=<?=$row['id_admin']?>
									<span class="glyphicon glyphicon-remove btn-xs"></span></a>
	                            </td>
	                        </tr>
	                        <?php endwhile ?>
	                    <?php endif ?>
	                </tbody>
	            </table>
	    </div>
	    
	            <div class="panel-footer hidden-print">
			        <a onClick="window.print();return false" class="btn"><i class="glyphicon glyphicon-print"></i></a>
			    </div>
	    </div>
	</div>
</div>