<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
  </head>
  <body>
    @include('partials.auth-nav')

    <div class="d-flex justify-content-center">
      <div class="shadow-sm border rounded" style="width: 33.33%; margin-top: 100px; padding: 25px;">
        @yield('content')
      </div>
    </div>

    @stack('scripts')
  </body>
</html>
