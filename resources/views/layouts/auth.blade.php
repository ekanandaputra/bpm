<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Clinic MR')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { display:flex; align-items:center; justify-content:center; min-height:100vh; background:#f7f9fc; }
        .auth-page { width:100%; max-width:420px; padding:24px; }
        .auth-card{ background:#fff; border-radius:8px; padding:28px; box-shadow:0 6px 18px rgba(0,0,0,0.08); }
        .brand{ font-weight:700; font-size:20px; margin-bottom:12px; }
        .error-box{ color:#842029; background:#f8d7da; padding:8px 12px; border-radius:6px; margin-bottom:12px; }
        .field{ display:block; margin-bottom:12px; }
        .field span{ display:block; margin-bottom:6px; color:#6b7280; }
        .pw-wrap{ display:flex; align-items:center; gap:8px }
        .pw-toggle{ background:transparent; border:none; cursor:pointer }
        .btn-primary{ display:inline-block; padding:10px 16px; background:#0069d9; color:#fff; border-radius:6px; border:none }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    @stack('scripts')
</body>
</html>
