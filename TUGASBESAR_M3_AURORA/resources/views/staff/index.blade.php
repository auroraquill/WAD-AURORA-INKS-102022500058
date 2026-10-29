<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Staff & Pegawai</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="{{ asset('images/logorestau.png') }}" alt="Logo" class="logo">
  </div>

  <div class="card">
    <div class="card-head">
      <h2>DATA PEGAWAI</h2>
      <a href="{{ route('staff.create') }}" class="btn-tambah">+ TAMBAH BARU</a>
    </div>

    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table id="tabel" class="tabel-pegawai">
      <thead>
        <tr>
          <th>No.</th><th>Nama Pegawai</th><th>Jabatan</th><th>Nomor Kontak</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawai as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->jabatan }}</td>
          <td>{{ $p->kontak }}</td>
          <td>
            <div class="aksi-wrap">
              <a href="{{ route('staff.edit', $p->id) }}" class="aksi edit">EDIT</a>
              <button type="button" class="aksi hapus btn-hapus"
                  data-url="{{ route('staff.destroy', $p->id) }}"
                  data-nama="{{ $p->nama }}">HAPUS</button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="modal-overlay" id="modalHapus">
    <div class="modal-box">
      <h3>Hapus Pegawai?</h3>
      <p>Yakin mau menghapus <b id="namaHapus"></b>?</p>
      <form id="formHapus" method="post">
        @csrf
        @method('DELETE')
        <button type="button" class="btn-batal" id="btnBatal">Batal</button>
        <button type="submit" class="btn-yakin">Ya, Hapus</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script>
    $('#tabel').DataTable();
    const modal = document.getElementById('modalHapus');

    document.addEventListener('click', function (e) {
      const btn = e.target.closest('.btn-hapus');
      if (!btn) return;
      document.getElementById('formHapus').action = btn.dataset.url;
      document.getElementById('namaHapus').textContent = btn.dataset.nama;
      modal.classList.add('show');
    });
    document.getElementById('btnBatal').onclick = () => modal.classList.remove('show');
    modal.onclick = e => { if (e.target === modal) modal.classList.remove('show'); };
  </script>
</body>
</html>