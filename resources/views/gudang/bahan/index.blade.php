<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bahan Baku - Sistem MBG</title>
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

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Bahan Baku</h2>
            <a href="{{ route('gudang.bahan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Bahan Baku
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bahanBaku as $index => $bahan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bahan->nama }}</td>
                                    <td>{{ $bahan->kategori }}</td>
                                    <td>{{ $bahan->jumlah }}</td>
                                    <td>{{ $bahan->satuan }}</td>
                                    <td>{{ $bahan->tanggal_masuk->format('d-m-Y') }}</td>
                                    <td>{{ $bahan->tanggal_kadaluarsa->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $bahan->status_badge }}">
                                            {{ $bahan->status_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('gudang.bahan.edit', $bahan->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            Edit Stok
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data bahan baku</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="card">
                <div class="card-header">
                    <strong>Keterangan Status:</strong>
                </div>
                <div class="card-body">
                    <span class="badge bg-success">Tersedia</span> : Stok tersedia dan layak digunakan<br>
                    <span class="badge bg-warning">Segera Kadaluarsa</span> : Akan kadaluarsa dalam 3 hari atau kurang<br>
                    <span class="badge bg-danger">Kadaluarsa</span> : Sudah melewati tanggal kadaluarsa<br>
                    <span class="badge bg-secondary">Habis</span> : Stok habis (jumlah = 0)
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
