<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
  </head>
  <body>

    <x-css.style />

    <x-js.script />

    <div class="row m-0">

      <div class="col-3 d-flex flex-column border text-center shadow-sm vh-100">
        <x-partials.app-nav />
      </div>

      <div class="col-9">
        {{ $slot }}
      </div>

    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
      });
    </script>

  </body>
</html>
