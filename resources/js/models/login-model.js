export class LoginModel {
  async authenticateAuthor(authorCredential) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'login',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(authorCredential),
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
