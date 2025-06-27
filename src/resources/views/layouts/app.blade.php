<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('css')
</head>
<body>
    <header class="header">
        <h1>FashionablyLate</h1>
        <div class="header-button">
            @yield('header-buttons')
        </div>
    </header>

    <main>
        @yield('content') 
    </main>
</body>
</html>