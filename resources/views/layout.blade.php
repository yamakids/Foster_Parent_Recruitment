<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>里親募集</title>
    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    >
    <!-- Fonts -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

       <!-- Styles -->
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">

       <link rel="stylesheet" href="css/button.css">

       @livewireStyles

       <!-- Scripts -->
       <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>
<body>
    <header class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">
                里親募集
            </a>
        </div>

    </header>

    <a href="{{ url('/login') }}" class="text-sm text-gray-700 underline btn-flat-border">Login</a>

    <a href="{{ url('/register') }}" class="ml-4 text-sm text-gray-700 underline btn-flat-border">Register</a>

    @livewire('navi')

    <a class="dropdown-item" style="margin-top:50px;" href="/portfolio/{{auth()->id()}}">マイポートフォリオ</a>

    <a class="dropdown-item" style="margin-top:20px;" href="{{ url('/subscribes') }}">応募状況</a>

    <a class="dropdown-item" "text-right"  style="margin-top:20px;" href="/wishes">案件登録</a>

    <div style="margin-top:30px;">
        @yield('content')
    </div>
</body>
</html>
