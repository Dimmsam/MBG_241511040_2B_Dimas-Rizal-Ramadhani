<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan Baku - Sistem MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem MBG - Petugas Gudang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gudang.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('gudang.bahan.index') }}">Bahan Baku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gudang.permintaan.index') }}">Permintaan</a>
                    </li>
                </ul>
                <span class="navbar-text me-3">
                    {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Bahan Baku Baru</h5>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('gudang.bahan.store') }}" method="POST" id="formTambah">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Bahan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" 
                                        id="kategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Karbohidrat" {{ old('kategori') == 'Karbohidrat' ? 'selected' : '' }}>Karbohidrat</option>
                                    <option value="Protein Hewani" {{ old('kategori') == 'Protein Hewani' ? 'selected' : '' }}>Protein Hewani</option>
                                    <option value="Protein Nabati" {{ old('kategori') == 'Protein Nabati' ? 'selected' : '' }}>Protein Nabati</option>
                                    <option value="Sayuran" {{ old('kategori') == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                                    <option value="Bahan Masak" {{ old('kategori') == 'Bahan Masak' ? 'selected' : '' }}>Bahan Masak</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                               id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="0">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('satuan') is-invalid @enderror" 
                                                id="satuan" name="satuan">
                                            <option value="">Pilih Satuan</option>
                                            <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                            <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                            <option value="butir" {{ old('satuan') == 'butir' ? 'selected' : '' }}>Butir</option>
                                            <option value="potong" {{ old('satuan') == 'potong' ? 'selected' : '' }}>Potong</option>
                                            <option value="ikat" {{ old('satuan') == 'ikat' ? 'selected' : '' }}>Ikat</option>
                                        </select>
                                        @error('satuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                               id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" 
                                               id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}">
                                        @error('tanggal_kadaluarsa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('gudang.bahan.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        // Konfirmasi sebelum submit
        document.getElementById('formTambah').addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menambahkan bahan baku ini?')) {
                this.submit();
            }
        });
    </script>
</body>
</html>
