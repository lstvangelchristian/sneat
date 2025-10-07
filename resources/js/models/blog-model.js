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

  async renderUpdateModal(blogId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `blog/update/${blogId}`,
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async updateBlog(updateBlog) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `blog/update/${updateBlog.blogId}`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(updateBlog.data),
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr.responseJSON.errors);
        }
      });
    });
  }

  async deleteBlog(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `blog/delete/${id}`,
        method: 'DELETE',
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr.responseJSON.errors);
        }
      });
    });
  }

  async createReaction(reactionData) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `reaction`,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(reactionData),
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async getReactions(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `reaction/${id}`,
        method: 'GET',
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }
}
