export class LoginView {
  constructor() {
    this.$loginForm = $('#login-form');
    this.$loginFields = $('input');
    this.$errorContainer = $('.error');
  }

  async authenticateAuthor(callback) {
    this.$loginForm.on('submit', e => {
      e.preventDefault();

      const loginFormData = new FormData(this.$loginForm[0]);

      const authorCredential = {
        username: loginFormData.get('username'),
        password: loginFormData.get('password')
      };

      callback(authorCredential);
    });
  }

  async showErrors(errors) {
    this.$errorContainer.text('');

    $.each(errors, (errKey, errArr) => {
      const errDiv = $(`.${errKey}-error`);

      $.each(errArr, (_, err) => {
        errDiv.append(`<p class="text-center text-danger mt-3">${err}</p>`);
      });
    });
  }

  async hideErrorsOnFieldFocus() {
    this.$loginFields.each((_, field) => {
      $(field).on('focus', () => {
        this.$errorContainer.text('');
      });
    });
  }
}
