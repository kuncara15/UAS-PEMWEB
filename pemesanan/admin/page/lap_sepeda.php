<?php
if (isset($_GET["action"])) {
	$now = date("Y-m-d H").":00:00";
	$sql = "UPDATE transaksi";
	if ($_GET["action"] == "ambil") {
		$sql .= " SET tgl_ambil='$now'";
	} elseif ($_GET["action"] == "kembali") {
		$query = $connection->query("SELECT * FROM transaksi JOIN detail_transaksi USING(id_transaksi) WHERE id_transaksi=$_GET[key]");
		$r = $query->fetch_assoc();
		$sql .= " SET tgl_kembali='$now', status='1'";
		$connection->query("UPDATE sepeda SET status='1' WHERE id_sepeda=".$r["id_sepeda"]);

	}
	$sql .= " WHERE id_transaksi=$_GET[key]";
	if ($connection->query($sql)) {
		echo alert("Berhasil", "?page=lap_sepeda");
	}
}
?>

<br>
<?php ?>
	<div class="panel panel-info">
		<div class="panel-heading"><h3 class="text-center">LAPORAN PENYEWAAN SEPEDA</h3><br></div>
		<div class="panel-body">
				<table class="table table-condensed table-hover table-responsive">
						<thead>
								<tr>
										<th>No</th>
										<th>Nama Pelanggan</th>
										<th>Nama Sepeda</th>
										<th>Nomor Sepeda</th>
										<th>Tanggal Sewa</th>
										<th>Tanggal Ambil</th>
										<th>Tanggal Kembali</th>
										<th>Lama Sewa</th>
										<th>Total Harga</th>
										<th class="hidden-print"></th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT * FROM transaksi t JOIN sepeda m USING(id_sepeda) JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
												<td><?=$no++?></td>
												<td><?=$row['nama']?></td>
												<td><?=$row['nama_sepeda']?></td>
												<td><?=$row['no_sepeda']?></td>
												<td><?=date("d-m-Y H:i:s", strtotime($row['tgl_sewa']))?></td>
												<td><?=($row['tgl_ambil']) ? date("d-m-Y H:i:s", strtotime($row['tgl_ambil'])) : "<b>Belum Diambil</b>" ?></td>
												<td><?=($row['tgl_kembali']) ? date("d-m-Y H:i:s", strtotime($row['tgl_kembali'])) : "<b>Belum Dikembalikan</b>" ?></td>
												<td><?=$row['lama']?> Hari</td>
												<td>Rp.<?=number_format($row['total_harga'])?>,-</td>
												<td class="hidden-print">
														<div class="btn-group">
															<?php if (($row["konfirmasi"] == 1) AND ($row["tgl_ambil"] == NULL) AND ($row["tgl_kembali"] == NULL)): ?>
																<a href="?page=lap_perperiode&action=ambil&key=<?=$row['id_transaksi']?>" class="btn btn-xs">Ambil</a> -->
															<?php endif; ?>
															<?php if ($row["konfirmasi"] AND $row["tgl_kembali"] == NULL): ?>
																<a href="?page=lap_sepeda&action=kembali&key=<?=$row['id_transaksi']?>" class="btn btn-xs">Dikembalikan</a>
															<?php endif; ?>
														</div>
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
<?php?>
