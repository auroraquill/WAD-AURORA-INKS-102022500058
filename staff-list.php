<?php
require __DIR__ . '/koneksi.php';
$pegawai = koneksi()->query('SELECT id, nama, jabatan, kontak FROM pegawai ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Staff & Pegawai</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="logo (2).png" alt="Logo" class="logo">
  </div>

  <div class="card">
    <div class="card-head">
      <h2>DATA PEGAWAI</h2>
      <a href="staff-form.php" class="btn-tambah">+ TAMBAH BARU</a>
    </div>

    <table id="tabel" class="tabel-pegawai">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Pegawai</th>
          <th>Jabatan</th>
          <th>Nomor Kontak</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($pegawai as $p): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($p['nama']) ?></td>
          <td><?= htmlspecialchars($p['jabatan']) ?></td>
          <td><?= htmlspecialchars($p['kontak']) ?></td>
          <td>
            <div class="aksi-wrap">
              <a href="staff-lihat.php?id=<?= $p['id'] ?>" class="aksi lihat">LIHAT</a>
              <a href="staff-edit.php?id=<?= $p['id'] ?>" class="aksi edit">EDIT</a>
              <button type="button" class="aksi hapus btn-hapus"
                      data-id="<?= $p['id'] ?>"
                      data-nama="<?= htmlspecialchars($p['nama']) ?>">HAPUS</button>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal konfirmasi hapus -->
  <div class="modal-overlay" id="modalHapus">
    <div class="modal-box">
      <h3>Hapus Pegawai?</h3>
      <p>Yakin mau menghapus <b id="namaHapus"></b>? Data tidak bisa dikembalikan.</p>
      <form action="staff-hapus.php" method="post">
        <input type="hidden" name="id" id="idHapus">
        <button type="button" class="btn-batal" id="btnBatal">Batal</button>
        <button type="submit" class="btn-yakin">Ya, Hapus</button>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('modalHapus');

    // event delegation: tetap jalan walau tabel di-paging/search
    document.addEventListener('click', function (e) {
      const btn = e.target.closest('.btn-hapus');
      if (!btn) return;
      document.getElementById('idHapus').value = btn.dataset.id;
      document.getElementById('namaHapus').textContent = btn.dataset.nama;
      modal.classList.add('show');
    });

    document.getElementById('btnBatal').addEventListener('click', function () {
      modal.classList.remove('show');
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.classList.remove('show');
    });
  </script>

</body>
</html>