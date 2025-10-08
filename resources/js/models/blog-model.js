export class BlogModel {
  async #request(url = '', method = 'GET', data = undefined) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: url,
        method: method,
        contentType: 'application/json',
        data: data,
        success: response => {
          return response;
        },
        error: xhr => {
          return xhr;
        }
      });
    });
  }

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

  async deleteComment(commentId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `comment/${commentId}`,
        method: 'DELETE',
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async getReplies(commentId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `replies/${commentId}`,
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

  async createReply(replyData) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `replies`,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(replyData),
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async getReply(replyId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `reply/${replyId}`,
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

  async updateReply(replyData) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `reply`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(replyData),
        success: function (response) {
          resolve(response);
        },
        error: function (xhr) {
          reject(xhr);
        }
      });
    });
  }

  async deleteReply(replyId) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: `reply/${replyId}`,
        method: 'DELETE',
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
