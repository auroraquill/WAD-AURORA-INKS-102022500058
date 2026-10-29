<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Tambah Pegawai</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="{{ asset('images/logorestau.png') }}" alt="Logo" class="logo">
  </div>

  <div class="page-center">
    <h1>Formulir Tambah Pegawai</h1>
    <p>Isi data pegawai baru pada formulir di bawah ini.</p>

    @if ($errors->any())
      <div class="alert-error">
        @foreach ($errors->all() as $err)
          <p>{{ $err }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('staff.store') }}" method="post" class="form-box">
      @csrf
      <label for="nama">Nama Pegawai:</label>
      <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>

      <label for="jabatan">Jabatan:</label>
      <select id="jabatan" name="jabatan">
        @foreach (['Chef', 'Waiter', 'Kasir'] as $j)
          <option value="{{ $j }}" @selected(old('jabatan') === $j)>{{ $j }}</option>
        @endforeach
      </select>

      <label for="kontak">Nomor Kontak:</label>
      <input type="text" id="kontak" name="kontak" value="{{ old('kontak') }}" required>

      <input type="submit" value="Simpan">
    </form>

    <p><a href="{{ route('staff.index') }}" class="btn-back">Kembali ke Data Staff & Pegawai</a></p>
  </div>
</body>
</html>