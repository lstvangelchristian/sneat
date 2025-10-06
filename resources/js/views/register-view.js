export class RegisterView {
  constructor() {
    this.$registrationForm = $('#registration-form');
    this.$registrationFields = $('input');
    this.$errorContainer = $('.error');
  }

  async createAuthor(callback) {
    this.$registrationForm.on('submit', e => {
      e.preventDefault();

      const registrationFormData = new FormData(this.$registrationForm[0]);

      const newAuthor = {
        username: registrationFormData.get('username'),
        password: registrationFormData.get('password'),
        confirmPassword: registrationFormData.get('confirm-password')
      };

      callback(newAuthor);
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
    this.$registrationFields.each((_, field) => {
      $(field).on('focus', () => {
        this.$errorContainer.text('');
      });
    });
  }
}
