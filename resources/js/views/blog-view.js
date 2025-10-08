export class BlogView {
  constructor() {
    this.$createBlogField = $('.create-blog-field');
    this.$createBlogForm = $('#create-blog-form');
    this.$blogsContainer = $('#blogs-container');
  }

  async makeBlogFieldResize() {
    this.$createBlogField.on('focus', function () {
      $(this).attr('rows', 5);
    });

    this.$createBlogField.on('blur', function () {
      if ($(this).val()) return;
      $(this).attr('rows', 1);
    });
  }

  async disableButton(disableButtonData) {
    const hasEmptyFields = Object.values(disableButtonData.data).includes('');

    const hasMinLength = Object.values(disableButtonData.data).some(val => val.length <= 10);

    if (!hasEmptyFields && !hasMinLength) {
      disableButtonData.form.find('button[type="submit"]').prop('disabled', true);
    }
  }

  async enableCreateButton(form) {
    form.find('button[type="submit"]').prop('disabled', false);
  }

  async createBlog(callback) {
    this.$createBlogForm.on('submit', async e => {
      e.preventDefault();

      const createBlogFormData = new FormData(this.$createBlogForm[0]);

      const newBlog = { content: createBlogFormData.get('blog-content') };

      const disableButtonData = {
        form: this.$createBlogForm,
        data: newBlog
      };

      await this.disableButton(disableButtonData);

      callback(newBlog).finally(async () => {
        await this.enableCreateButton(this.$createBlogForm);
      });
    });
  }

  async getBlogId(callback) {
    $(document).on('click', '.js-edit-blog', async e => {
      const blogId = $(e.currentTarget).data('blogId');
      const action = $(e.currentTarget).data('blogAction');
      callback({ blogId, action });
    });
  }

  async renderModal(content) {
    $('body').append(content);

    $('#updateBlogModal').modal('show');

    $('#updateBlogModal').on('hidden.bs.modal', function () {
      $(this).remove();
    });
  }

  async updateBlog(callback) {
    $(document).on('submit', '#updateBlogForm', async e => {
      e.preventDefault();

      const updateBlogFormData = new FormData(e.currentTarget);

      const blogId = updateBlogFormData.get('blog-id');
      const updatedContent = updateBlogFormData.get('updated-content');

      const disableButtonData = {
        form: $('#updateBlogForm'),
        data: { updatedContent }
      };

      await this.disableButton(disableButtonData);

      callback({ blogId, data: { updatedContent } }).finally(async () => {
        await this.enableCreateButton(disableButtonData.form);
      });
    });
  }

  async deleteBlog(callback) {
    $(document).on('click', '.js-delete-blog', async e => {
      e.preventDefault();

      const blogId = $(e.currentTarget).data('blogId');

      const deleteBlog = { isClicked: true, blogId };

      callback(deleteBlog);
    });
  }

  async createReact(callback) {
    $(document).on('click', '.react-btn', e => {
      const type_id = $(e.currentTarget).data('reactionId');
      const blog_id = $(e.currentTarget).closest('.reaction-container').data('blogId');

      const reactionData = { type_id, blog_id };

      callback(reactionData);
    });
  }

  async showReaction(callback) {
    $(document).on('click', '.show-reaction', e => {
      const blog_id = $(e.currentTarget).closest('.show-reaction').data('blogId');

      callback(blog_id);
    });
  }

  async renderReactionModal(content) {
    $('body').append(content);

    $('#getReactionModal').modal('show');

    $('#getReactionModal').on('hidden.bs.modal', function () {
      $(this).remove();
    });
  }

  async getCreateCommentContent(callback) {
    $(document).on('click', '.comment-btn', e => {
      const blogId = $(e.currentTarget).data('blogId');

      callback({ isClicked: true, blogId });
    });
  }

  async renderCreateCommentContent(content) {
    $('body').append(content);

    $('#createCommentModal').modal('show');

    $('#createCommentModal').on('hidden.bs.modal', function () {
      $(this).remove();
    });
  }

  async createComment(callback) {
    $(document).on('submit', '#createCommentForm', e => {
      e.preventDefault();

      const commentFormData = new FormData(e.currentTarget);

      const commentData = {
        blogId: commentFormData.get('blog-id'),
        content: commentFormData.get('content')
      };

      callback(commentData);
    });
  }

  async showComments(callback) {
    $(document).on('click', '.show-comments', e => {
      const blog_id = $(e.currentTarget).closest('.show-comments').data('blogId');

      callback(blog_id);
    });
  }

  async renderCommentContent(content) {
    $('body').append(content);

    $('#getCommentsModal').modal('show');

    $('#getCommentsModal').on('hidden.bs.modal', function () {
      $(this).remove();
    });
  }

  async renderBlogs(updatedBlogs) {
    this.$blogsContainer.empty();

    this.$blogsContainer.html(updatedBlogs);
  }

  async editComment(callback) {
    $(document).on('click', '.js-edit-comment', async e => {
      const commentId = $(e.currentTarget).data('commentId');
      const blogId = $(e.currentTarget).data('blogId');
      await callback({ commentId, blogId });
    });
  }

  async showEditableComment(result) {
    $(`.js-comment-${result.commentId}`).html(result.content);
  }

  async cancelEditComment(callback) {
    $(document).on('click', '.js-cancel-edit-comment', async e => {
      const blogId = $(e.currentTarget).data('blogId');
      await callback(blogId);
    });
  }

  async loadComments(comments) {
    const commentsDiv = $('#getCommentsModal .comments-container');

    console.log(commentsDiv);
    console.log(comments);

    commentsDiv.empty();

    if (comments) {
      commentsDiv.html(comments);
    }
  }

  async updateComment(callback) {
    $(document).on('submit', '#updateCommentForm', async e => {
      e.preventDefault();

      const updateCommentForm = new FormData(e.currentTarget);

      const commentId = updateCommentForm.get('comment-id');
      const updatedComment = updateCommentForm.get('updated-content');
      const blogId = updateCommentForm.get('blog-id');

      await callback({ commentId, updatedComment }, blogId);
    });
  }

  async hideModal(modalId) {
    $(`${modalId}`).modal('hide');
  }

  async showDeleteConfirmation(retrieveId) {
    $(document).on('click', '.js-delete-comment', async e => {
      const commentId = $(e.currentTarget).data('commentId');
      const blogId = $(e.currentTarget).data('blogId');
      await retrieveId({ commentId, blogId });
    });
  }

  async showReplies(retrieveCommentId) {
    $(document).on('click', '.js-show-replies', async e => {
      const commentId = $(e.currentTarget).data('commentId');

      console.log(commentId);

      if ($(e.currentTarget).hasClass('active')) {
        $(`.js-replies-container-${commentId}`).empty();
        $(e.currentTarget).removeClass('active');
        return;
      }

      $(e.currentTarget).addClass('active');
      await retrieveCommentId(commentId);
    });
  }

  async renderReplies(result) {
    console.log($(`.js-replies-container-${result.commentId}`));
    $(`.js-replies-container-${result.commentId}`).html(result.view);
  }

  async createReply(retrieveNewReply) {
    $(document).on('submit', '#createReplyForm', async e => {
      e.preventDefault();

      const createReplyFormData = new FormData(e.currentTarget);

      const commentId = createReplyFormData.get('comment-id');
      const content = createReplyFormData.get('content');

      await retrieveNewReply({ commentId, content });
    });
  }

  async retrieveReplyData(retrieveData) {
    $(document).on('click', '.js-edit-reply', async e => {
      const replyId = $(e.currentTarget).data('reply-id');
      const commentId = $(e.currentTarget).data('comment-id');

      retrieveData({ replyId, commentId });
    });
  }

  async makeReplyContentEditable(result) {
    console.log(result);
    const replyContainer = $(`.reply-content-container-${result.replyId}`);
    replyContainer.empty();
    replyContainer.html(result.view);
  }

  async cancelEditReply(callback) {
    $(document).on('click', '.js-cancel-reply', async e => {
      const commentId = $(e.currentTarget).data('commentId');
      await callback(commentId);
    });
  }

  async updateReply(callback) {
    $(document).on('submit', '#updateReplyForm', async e => {
      e.preventDefault();

      const updateReplyForm = new FormData(e.currentTarget);

      const replyId = updateReplyForm.get('reply-id');
      const commentId = updateReplyForm.get('comment-id');
      const updatedReply = updateReplyForm.get('updated-reply');

      await callback({ replyId, updatedReply }, commentId);
    });
  }

  async deleteReply(callback) {
    $(document).on('click', '.js-delete-reply', async e => {
      const replyId = $(e.currentTarget).data('reply-id');
      const commentId = $(e.currentTarget).data('comment-id');

      await callback({ replyId, commentId });
    });
  }
}
