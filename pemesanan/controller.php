<?php
date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H:i:s");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/**
 * Database connection setup
 */
 if (!$connection = new Mysqli("localhost", "id20048511_gowes", "sk$]}7ngYYQWS4A*", "id20048511_sepeda")) {
  echo "<h3>ERROR: Koneksi database gagal!</h3>";
 }
/**
 * Page initialize
 */
if (isset($_GET["page"])) {
  $_PAGE = $_GET["page"];
  $_ADMINPAGE = $_GET["page"];
} else {
  $_PAGE = "home";
  $_ADMINPAGE = "home";
}
/**
 * Page setup
 * @param page
 * @return page filename
 */
function page($page) {
  return "pelanggan/" . $page . ".php";
}
/**
 * Page setup
 * @param page
 * @return page filename
 */
function adminPage($page) {
  return "page/" . $page . ".php";
}

/**
 * Alert notification
 * @param message, redirection
 * @return alert notify
 */
function alert($msg, $to = null) {
  $to = ($to) ? $to : $_SERVER["PHP_SELF"];
  return "<script>alert('{$msg}');window.location='{$to}';</script>";
}

// Update otomatis
$query = $connection->query("SELECT a.id_sepeda, a.id_transaksi, (DATEDIFF(NOW(), a.tgl_ambil)) AS tgl FROM transaksi a WHERE a.status='0'");


// Pembatalan otomatis
$query = $connection->query("SELECT a.jatuh_tempo, a.id_transaksi, a.id_sepeda, (TIMESTAMPDIFF(HOUR, a.tgl_sewa, NOW())) AS tempo FROM transaksi a WHERE a.konfirmasi='0'");
while ($data = $query->fetch_assoc()) {
  if ($data["tempo"] > 3) {
    $connection->query("UPDATE transaksi SET pembatalan='1' WHERE id_transaksi=$data[id_transaksi]");
    $connection->query("UPDATE sepeda SET status='1' WHERE id_sepeda=$data[id_sepeda]");
   
  }
}

// Perhitungan deneda otomatis CONTOH : ADDDATE('2017-01-01', INTERVAL 1 DAY)
$sql = "SELECT
          a.id_transaksi,
          (
            TIMESTAMPDIFF(
              HOUR,
              ADDDATE(a.tgl_ambil, INTERVAL a.lama DAY),
              a.tgl_kembali
            )
          ) AS terlambat,
          1000 * (TIMESTAMPDIFF(HOUR, ADDDATE(a.tgl_ambil, INTERVAL a.lama DAY), a.tgl_kembali)) AS denda
        FROM transaksi a
        WHERE a.tgl_kembali <> ''";
$query = $connection->query($sql);
while ($a = $query->fetch_assoc()) { //
  if ($a["denda"] > 0) { //
      if (!$connection->query("UPDATE transaksi SET denda=$a[denda] WHERE id_transaksi=$a[id_transaksi]")) {
        die("Hitung denda otomatis gagal.");
      }
  }
}
