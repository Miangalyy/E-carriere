<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @routes

        <title>Test</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
       <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">-->
    
  
        <!-- Scripts -->
       
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <script src="{{ asset('js/jQueryStyle.js') }}" defer></script>
        <script src="{{ asset('js/LoginScript.js') }}" defer></script>
        <script src="{{ asset('js/Card.js') }}" defer></script>
        <script src="{{ asset('js/swiper-bundle.min.js') }}" defer></script>
      <!--  <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>-->
        <script src="{{ asset('js/youtube.js') }}" defer></script>
        <script src="{{ asset('js/smooth-scroll.js') }}" defer></script>
      <!--  <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" defer></script>-->
        
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>