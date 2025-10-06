export class LoginContr {
  constructor(model, view) {
    this.model = model;
    this.view = view;
  }

  async init() {
    await this.view.authenticateAuthor(async authorCredential => {
      try {
        const result = await this.model.authenticateAuthor(authorCredential);

        if (result.success) {
          location.href = result.redirect;
        } else {
          console.log(result.errors);
          await this.view.showErrors(result.errors);
        }
      } catch (errors) {
        await this.view.showErrors(errors);
      }
    });

    await this.view.hideErrorsOnFieldFocus();
  }
}
