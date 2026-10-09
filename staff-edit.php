<?php
require __DIR__ . '/data.php';

$jabatanValid = ['Chef', 'Waiter', 'Kasir'];
$error = '';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

$p = ambilSatu($id);
if (!$p) {
    header('Location: staff-list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama'] ?? '');
    $jabatan = $_POST['jabatan'] ?? '';
    $kontak  = trim($_POST['kontak'] ?? '');

    if ($nama === '' || $kontak === '') {
        $error = 'Nama dan nomor kontak wajib diisi.';
    } elseif (!in_array($jabatan, $jabatanValid, true)) {
        $error = 'Jabatan tidak valid.';
    } else {
        ubahPegawai($id, $nama, $jabatan, $kontak);
        header('Location: staff-list.php');
        exit;
    }
    // kalau error, tampilkan lagi isian yang barusan diketik
    $p = ['nama' => $nama, 'jabatan' => $jabatan, 'kontak' => $kontak];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pegawai</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="logo (2).png" alt="Logo" class="logo">
  </div>

  <div class="page-center">
    <h1>Edit Pegawai</h1>
    <p>Ubah data pegawai pada formulir di bawah ini.</p>

    <?php if ($error): ?>
      <p style="color:#c0392b;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="staff-edit.php" method="post" class="form-box">
      <input type="hidden" name="id" value="<?= $id ?>">

      <label for="nama">Nama Pegawai:</label><br>
      <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($p['nama']) ?>" required><br><br>

      <label for="jabatan">Jabatan:</label><br>
      <select id="jabatan" name="jabatan">
        <?php foreach ($jabatanValid as $j): ?>
          <option value="<?= $j ?>" <?= ($p['jabatan'] === $j) ? 'selected' : '' ?>><?= $j ?></option>
        <?php endforeach; ?>
      </select><br><br>

      <label for="kontak">Nomor Kontak:</label><br>
      <input type="text" id="kontak" name="kontak" value="<?= htmlspecialchars($p['kontak']) ?>" required><br><br>

      <input type="submit" value="Simpan Perubahan">
    </form>

    <p><a href="staff-list.php" class="btn-back">Kembali ke Data Staff & Pegawai</a></p>
  </div>

</body>
</html>