<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h4 class="headerTitle">Baan 4</h4>
        <h4 class="headerTitle">Danny en Walter</h4>
        
        <div class="contentContainer">
            <h3 id="orderButton" onclick="submitOrder()">Bestelling</h3>
            {{-- <h3 class="contentTitle">Lucky Strike</h3>
            <img src="{{ asset('img/luckystrike.png') }}" alt="image" class="contentImage"> --}}
        </div>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>