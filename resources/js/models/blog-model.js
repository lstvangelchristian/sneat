export class BlogModel {
  async #request(url = '', method = 'GET', data = undefined) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url,
        method,
        contentType: 'application/json',
        data: data ? JSON.stringify(data) : null,
        success: response => {
          resolve(response);
        },
        error: hasError => {
          const errors = hasError.responseJSON.errors || hasError.errors;
          reject(errors);
        }
      });
    });
  }

  async createBlog(newBlog) {
    return await this.#request('blog', 'POST', newBlog);
  }

  async renderBlogs() {
    return await this.#request('blog');
  }

  async renderUpdateModal(blogId) {
    return await this.#request(`blog/update/${blogId}`);
  }

  async updateBlog(updateBlog) {
    return await this.#request(`blog/update/${updateBlog.blogId}`, 'PUT', updateBlog.data);
  }

  async deleteBlog(id) {
    return await this.#request(`blog/delete/${id}`, 'DELETE');
  }

  async createReaction(reactionData) {
    return await this.#request('reaction', 'POST', reactionData);
  }

  async getReactions(id) {
    return await this.#request(`reaction/${id}`);
  }

  async getCreateCommentContent(id) {
    return await this.#request(`comment/create/modal/${id}`);
  }

  async createComment(commentData) {
    return await this.#request('comment', 'POST', commentData);
  }

  async renderComments(id) {
    return await this.#request(`comment/${id}`);
  }

  async loadComments(blogId) {
    return await this.#request(`comment/load/${blogId}`);
  }

  async getComment(id) {
    return await this.#request(`comment/edit/${id}`);
  }

  async updateComment(updatedComment) {
    return await this.#request('comment', 'PUT', updatedComment);
  }

  async deleteComment(commentId) {
    return await this.#request(`comment/${commentId}`, 'DELETE');
  }

  async createReply(replyData) {
    return await this.#request('replies', 'POST', replyData);
  }

  async getReplies(commentId) {
    return await this.#request(`replies/${commentId}`);
  }

  async getReply(replyId) {
    return await this.#request(`reply/${replyId}`);
  }

  async updateReply(replyData) {
    return await this.#request('reply', 'PUT', replyData);
  }

  async deleteReply(replyId) {
    return await this.#request(`reply/${replyId}`, 'DELETE');
  }
}
