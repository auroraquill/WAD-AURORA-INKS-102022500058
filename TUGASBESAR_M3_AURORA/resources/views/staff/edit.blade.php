<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Edit Pegawai</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="site-title">
    <span>Restaurant & Cafe</span>
    <img src="{{ asset('images/logorestau.png') }}" alt="Logo" class="logo">
  </div>

  <div class="page-center">
    <h1>Formulir Edit Pegawai</h1>
    <p>Ubah data pegawai pada formulir di bawah ini.</p>

    @if ($errors->any())
      <div class="alert-error">
        @foreach ($errors->all() as $err)
          <p>{{ $err }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('staff.update', $staff->id) }}" method="post" class="form-box">
      @csrf
      @method('PUT')

      <label for="nama">Nama Pegawai:</label>
      <input type="text" id="nama" name="nama" value="{{ old('nama', $staff->nama) }}" required>

      <label for="jabatan">Jabatan:</label>
      <select id="jabatan" name="jabatan">
        @foreach (['Chef', 'Waiter', 'Kasir'] as $j)
          <option value="{{ $j }}" @selected(old('jabatan', $staff->jabatan) === $j)>{{ $j }}</option>
        @endforeach
      </select>

      <label for="kontak">Nomor Kontak:</label>
      <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $staff->kontak) }}" required>

      <input type="submit" value="Simpan Perubahan">
    </form>

    <p><a href="{{ route('staff.index') }}" class="btn-back">Kembali ke Data Staff & Pegawai</a></p>
  </div>
</body>
</html>