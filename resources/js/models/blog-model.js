export class BlogModel {
  async createBlog(newBlog) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'blog',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(newBlog),
        success: function (response) {
          resolve(response.success);
        },
        error: function (xhr) {
          reject(xhr.responseJSON.errors);
        }
      });
    });
  }
}
