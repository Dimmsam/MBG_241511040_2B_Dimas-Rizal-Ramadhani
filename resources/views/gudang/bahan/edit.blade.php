<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stok Bahan - Sistem MBG</title>
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
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Update Stok Bahan Baku</h5>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- Informasi Bahan -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Informasi Bahan</h6>
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td width="150"><strong>Nama Bahan</strong></td>
                                        <td>: {{ $bahan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kategori</strong></td>
                                        <td>: {{ $bahan->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Satuan</strong></td>
                                        <td>: {{ $bahan->satuan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stok Saat Ini</strong></td>
                                        <td>: <strong class="text-primary">{{ $bahan->jumlah }} {{ $bahan->satuan }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>: <span class="badge bg-{{ $bahan->status_badge }}">{{ $bahan->status_label }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Form Update Stok -->
                        <form action="{{ route('gudang.bahan.update', $bahan->id) }}" method="POST" id="formUpdate">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Stok Baru <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('jumlah') is-invalid @enderror" 
                                       id="jumlah" 
                                       name="jumlah" 
                                       value="{{ old('jumlah', $bahan->jumlah) }}">
                                <small class="form-text text-muted">
                                    Masukkan jumlah stok yang baru (tidak boleh negatif)
                                </small>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('gudang.bahan.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-warning">Update Stok</button>
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
        document.getElementById('formUpdate').addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengubah stok?')) {
                this.submit();
            }
        });
    </script>
</body>
</html>