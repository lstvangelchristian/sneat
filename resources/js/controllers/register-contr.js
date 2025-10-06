export class RegisterContr {
  constructor(model, view) {
    this.model = model;
    this.view = view;
  }

  async init() {
    await this.view.createAuthor(async newAuthor => {
      try {
        const success = await this.model.createAuthor(newAuthor);
        location.href = success.redirect;
      } catch (errors) {
        await this.view.showErrors(errors);
      }
    });

    await this.view.hideErrorsOnFieldFocus();
  }
}
