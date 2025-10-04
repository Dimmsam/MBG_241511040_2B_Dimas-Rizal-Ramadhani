<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Saya - Sistem MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem MBG - Petugas Dapur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dapur.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dapur.permintaan.index') }}">Permintaan Saya</a>
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
        <h2 class="mb-4">Status Permintaan Bahan Saya</h2>

        <!-- Filter Status -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" onclick="filterStatus('semua')">
                        Semua
                    </button>
                    <button type="button" class="btn btn-outline-warning" onclick="filterStatus('menunggu')">
                        Menunggu
                    </button>
                    <button type="button" class="btn btn-outline-success" onclick="filterStatus('disetujui')">
                        Disetujui
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="filterStatus('ditolak')">
                        Ditolak
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($permintaan as $item)
                <div class="col-md-6 mb-3 permintaan-card" data-status="{{ $item->status }}">
                    <div class="card">
                        <div class="card-header" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <strong>Permintaan #{{ $item->id }}</strong>
                                </h6>
                                <span class="badge bg-{{ $item->status_badge }}">
                                    {{ $item->status_label }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-2">
                                <tr>
                                    <td width="150"><strong>Tanggal Masak</strong></td>
                                    <td>: {{ $item->tgl_masak->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Menu</strong></td>
                                    <td>: {{ $item->menu_makan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Porsi</strong></td>
                                    <td>: {{ $item->jumlah_porsi }} porsi</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Permintaan</strong></td>
                                    <td>: {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                                </tr>
                            </table>

                            <hr>
                            
                            <strong>Detail Bahan yang Diminta:</strong>
                            <div class="table-responsive mt-2">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan</th>
                                            <th>Jumlah Diminta</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($item->details as $index => $detail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($detail->bahan)
                                                        {{ $detail->bahan->nama }}
                                                    @else
                                                        <span class="text-muted fst-italic">Bahan telah dihapus</span>
                                                    @endif
                                                </td>
                                                <td>{{ $detail->jumlah_diminta }}</td>
                                                <td>
                                                    @if($detail->bahan)
                                                        {{ $detail->bahan->satuan }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($item->status === 'disetujui')
                                <div class="alert alert-success mt-2 mb-0">
                                    <small><strong>✓</strong> Permintaan Anda telah disetujui</small>
                                </div>
                            @elseif($item->status === 'ditolak')
                                <div class="alert alert-danger mt-2 mb-0">
                                    <small><strong>✗</strong> Permintaan Anda ditolak</small>
                                </div>
                            @else
                                <div class="alert alert-warning mt-2 mb-0">
                                    <small><strong>⏱</strong> Menunggu persetujuan dari petugas gudang</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Anda belum memiliki permintaan bahan
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function filterStatus(status) {
            const cards = document.querySelectorAll('.permintaan-card');
            const buttons = document.querySelectorAll('.btn-group button');
            
            // Reset active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (status === 'semua') {
                    card.style.display = 'block';
                } else {
                    if (card.dataset.status === status) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }
    </script>
</body>
</html>