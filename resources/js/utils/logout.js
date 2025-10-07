$(() => {
  const $logoutForm = $('#logout-form');

  if ($logoutForm) {
    $logoutForm.on('submit', e => {
      e.preventDefault();

      $.ajax({
        url: 'logout',
        method: 'POST',
        contentType: 'application/json',
        data: null,
        success: function (response) {
          if (response.success) location.href = response.redirect;
        },
        error: function (xhr) {
          console.log(xhr);
        }
      });
    });
  }
});
