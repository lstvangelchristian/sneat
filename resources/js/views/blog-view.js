export class BlogView {
  constructor() {
    this.$createBlogField = $('.create-blog-field');
    this.$createBlogForm = $('#create-blog-form');
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

  async hideModal(modalId) {
    $(`${modalId}`).modal('hide');
  }
}
