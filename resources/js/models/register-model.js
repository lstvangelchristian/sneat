export class RegisterModel {
  async createAuthor(newAuthor) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'register',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(newAuthor),
        success: function (result) {
          resolve(result);
        },
        error: function (result) {
          reject(result.responseJSON.errors);
        }
      });
    });
  }
}
