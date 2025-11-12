<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Absensi')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f6f7fb; }
    .card { border-radius:12px; }
    .table thead th { font-weight:600; font-size:13px; }
    .mahasiswa-nama { font-weight:700; }
    .mahasiswa-nim { font-size:0.85rem; color:#6c757d; }
  </style>
  @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ route('absensi.index') }}">AbsensiApp</a>
    <div>
      <a class="btn btn-outline-primary me-2" href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
      <a class="btn btn-primary" href="{{ route('absensi.index') }}">Absensi</a>
    </div>
  </div>
</nav>
<div class="container py-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
