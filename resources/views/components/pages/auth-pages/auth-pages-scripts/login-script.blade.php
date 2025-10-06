<script>
  document.addEventListener('DOMContentLoaded', () => {
    $(() => {
      const login = () => {
        const $loginForm = $('#login-form');

        $loginForm.on('submit', (e) => {
          e.preventDefault();

          const loginFormData = new FormData($loginForm[0]);

          const authorCredential = {
            username: loginFormData.get('username'),
            password: loginFormData.get('password'),
          };

          $.ajax({
            url: '{{ route('login') }}',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(authorCredential),
            success: function (response) {
              console.log(response);
              if (response.success) {
                location.href = response.redirect
                return;
              }

              if (!response.success) {
                $('.catch-error').
                  append(`<p class="text-center text-danger">${response.error}</p>`)
              }
            },
            error: function (xhr) {
              console.log(xhr);

              if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;

                const keys = ['username', 'password'];

                Object.entries(errors).forEach(([field, messages]) => {
                  const errorDiv = $(`.${field}-error`);

                  if (errorDiv.length && Array.isArray(messages)) {
                    messages.forEach(message => {
                      errorDiv.append(`<p class="text-center text-danger">${message}</p>`);
                    })
                  } else {
                    $('.catch-error')
                      .append(`<p class="text-center text-danger">${xhr.error}</p>`);
                  }
                })
              }
            }
          })
        })
      }

      login()

      const inputs = $("input");

      $("input").each(function() {
        $(this).on('focus', function() {
          $('.error').text('');
        });
      });
    })
  })
</script>
