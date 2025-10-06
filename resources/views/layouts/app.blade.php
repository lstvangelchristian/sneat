<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
  </head>
  <body>
    <div class="row m-0">

      <div class="col-3 d-flex flex-column border text-center shadow-sm vh-100">
        @include('partials.app-nav')
      </div>

      <div class="col-9">
        @yield('content')
      </div>

      @stack('scripts')

    </div>
  </body>
</html>
