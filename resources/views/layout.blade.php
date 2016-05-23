<!DOCTYPE html>
<html>
<head>
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <title>Latihan CRUD Laravel Vue JS</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        @yield('content')
    </div>
    <script src="/js/vendor.js"></script>

    @stack('scripts')

</body>
</html>