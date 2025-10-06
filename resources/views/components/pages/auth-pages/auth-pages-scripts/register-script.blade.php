  <script>
    document.addEventListener('DOMContentLoaded', () => {
      $(() => {
        const register = () => {
          $('#registration-form').on('submit', (e) => {
            e.preventDefault();

            const registrationFormData = new FormData($('#registration-form')[0]);

            const newAuthor = {
              username: registrationFormData.get('username'),
              password: registrationFormData.get('password'),
              confirmPassword: registrationFormData.get('confirm-password')
            };

            $.ajax({
              url: '{{ route('register') }}',
              method: 'POST',
              contentType: 'application/json',
              data: JSON.stringify(newAuthor),
              success: function (response) {
                if (response.success) {
                  window.location.href = response.redirect;
                }
              },
              error: function (xhr) {
                showErrors(xhr)
              }
            });
          })
        }

        register()

        const showErrors = (xhr) => {
          if (xhr.status === 422) {
            const errors = xhr.responseJSON.errors;

            const keys = ['username', 'password', 'confirmPassword'];

            Object.entries(errors).forEach(([field, messages]) => {
              const errorDiv = $(`.${field}-error`);

              if (errorDiv.length && Array.isArray(messages)) {
                messages.forEach(message => {
                  errorDiv.append(`<p class="text-center text-danger">${message}</p>`);
                });
              }
            });
          } else {
            $('.catch-error')
              .append(`<p class="text-center text-danger">${xhr.error}</p>`);
          }
        }

        const clearFieldsOnFocus = () => {
          const inputs = $("input");

          $("input").each(function() {
            $(this).on('focus', function() {
              $('.error').text('');
            });
          });
        }

        clearFieldsOnFocus();
      })
    })
  </script>
