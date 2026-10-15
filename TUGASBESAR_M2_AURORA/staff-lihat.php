<?php
require __DIR__ . '/koneksi.php';

$stmt = koneksi()->prepare('SELECT id, nama, jabatan, kontak FROM pegawai WHERE id = ?');
$stmt->execute([(int)($_GET['id'] ?? 0)]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) {
    header('Location: staff-list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pegawai</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="logo (2).png" alt="Logo" class="logo">
  </div>

  <div class="page-center">
    <h1>Detail Pegawai</h1>

    <div class="form-box">
      <div class="detail-row"><span>Nama Pegawai</span><?= htmlspecialchars($p['nama']) ?></div>
      <div class="detail-row"><span>Jabatan</span><?= htmlspecialchars($p['jabatan']) ?></div>
      <div class="detail-row"><span>Nomor Kontak</span><?= htmlspecialchars($p['kontak']) ?></div>
    </div>

    <p><a href="staff-list.php" class="btn-back">Kembali ke Data Staff & Pegawai</a></p>
  </div>

</body>
</html>