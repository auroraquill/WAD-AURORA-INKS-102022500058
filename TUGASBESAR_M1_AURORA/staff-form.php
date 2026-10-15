<?php
require __DIR__ . '/koneksi.php';

$jabatanValid = ['Chef', 'Waiter', 'Kasir'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama'] ?? '');
    $jabatan = $_POST['jabatan'] ?? '';
    $kontak  = trim($_POST['kontak'] ?? '');

    if ($nama === '' || $kontak === '') {
        $error = 'Nama dan nomor kontak wajib diisi.';
    } elseif (!in_array($jabatan, $jabatanValid, true)) {
        $error = 'Jabatan tidak valid.';
    } else {
        $stmt = koneksi()->prepare('INSERT INTO pegawai (nama, jabatan, kontak) VALUES (?, ?, ?)');
        $stmt->execute([$nama, $jabatan, $kontak]);
        header('Location: staff-list.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
     <title>Formulir Tambah Pegawai</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="logo (2).png" alt="Logo" class="logo">
  </div>

  <div class="page-center">
    <h1>Formulir Tambah Pegawai</h1>
    <p>Isi data pegawai baru pada formulir di bawah ini.</p>

    <h2>Formulir Pendaftaran Pegawai</h2>
    <?php if ($error): ?>
      <p style="color:#c0392b;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="staff-form.php" method="post" class="form-box">
      <label for="nama">Nama Pegawai:</label><br>
      <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required><br><br>

      <label for="jabatan">Jabatan:</label><br>
      <select id="jabatan" name="jabatan">
        <?php foreach ($jabatanValid as $j): ?>
          <option value="<?= $j ?>" <?= (($_POST['jabatan'] ?? '') === $j) ? 'selected' : '' ?>><?= $j ?></option>
        <?php endforeach; ?>
      </select><br><br>

      <label for="kontak">Nomor Kontak:</label><br>
      <input type="text" id="kontak" name="kontak" value="<?= htmlspecialchars($_POST['kontak'] ?? '') ?>" required><br><br>

      <input type="submit" value="Simpan">
    </form>

    <p><a href="staff-list.php" class="btn-back">Kembali ke Data Staff & Pegawai</a></p>
  </div>

</body>
</html>