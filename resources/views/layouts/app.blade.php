{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BorrowBase')</title>
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tilt+Warp&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('style.css') }}"> -->
     @yield('css')
</head>

<body>
    @yield('sidebar')
    @yield('content')
</body>

</html>