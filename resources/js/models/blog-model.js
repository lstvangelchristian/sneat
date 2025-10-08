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

  async getCreateCommentContent(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment/create/modal/${id}`,
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

  async createComment(commentData) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment`,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(commentData),
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async renderComments(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment/${id}`,
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

  async renderBlogs() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `blog`,
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

  async getComment(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment/edit/${id}`,
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

  async loadComments(blogId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment/load/${blogId}`,
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

  async updateComment(updatedComment) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(updatedComment),
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
