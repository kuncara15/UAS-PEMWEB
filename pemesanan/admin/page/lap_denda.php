<div class="panel">
			<div class="panel-heading table-responsive">
			    <h3 class="text-center">LAPORAN DENDA</h3><h4 class="text-center">
			<div class="panel-body">
					<table class="table table-condensed table-hover">
							<thead>
									<tr>
											<th>No</th>
											<th>Nama Pelanggan</th>
											<th>Tanggal Ambil</th>
											<th>Tanggal Kembali</th>
											<th>Terlambat</th>
											<th>Total Harga</th>
											<th>Denda</th>
											<th class="hidden-print"></th>

									</tr>
							</thead>
							<tbody>
									<?php $no = 1; ?>
									<?php if ($query = $connection->query("SELECT p.nama, t.total_harga, t.denda, t.tgl_sewa, t.tgl_ambil, t.tgl_kembali, (TIMESTAMPDIFF(HOUR, ADDDATE(t.tgl_ambil, INTERVAL t.lama DAY), t.tgl_kembali)) AS terlambat FROM transaksi t JOIN pelanggan p USING(id_pelanggan) WHERE t.denda != 0")): ?>
											<?php while($row = $query->fetch_assoc()): ?>
											<tr>
													<td><?=$no++?></td>
													<td><?=$row['nama']?></td>
													<td><?=date("d-m-Y H:i:s", strtotime($row['tgl_ambil']))?></td>
													<td><?=date("d-m-Y H:i:s", strtotime($row['tgl_kembali']))?></td>
													<td><?=$row['terlambat']?> jam</td>
													<td>Rp.<?=number_format($row['total_harga'])?>,-</td>
													<td>Rp.<?=number_format($row['denda'])?>,-</td>
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