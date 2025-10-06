<script>
  document.addEventListener('DOMContentLoaded', () => {
    $(() => {
      const $logoutForm = $('#logout-form');

      $logoutForm.on('submit', (e) => {
        e.preventDefault();

        $.ajax({
          url: '{{ route('logout') }}',
          method: 'POST',
          contentType: 'application/json',
          data: null,
          success: function (response) {
            if (response.success)
              location.href = response.redirect
          },
          error: function (xhr) {
            console.log(xhr);
          }
        })
      })
    })
  })
</script>
