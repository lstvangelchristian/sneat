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

  async disableCreateButton(newBlog) {
    if (newBlog.content !== '' && newBlog.content.length >= 10) {
      this.$createBlogForm.find('button[type="submit"]').prop('disabled', true);
    }
  }

  async enableCreateButton() {
    this.$createBlogForm.find('button[type="submit"]').prop('disabled', false);
  }

  async createBlog(callback) {
    this.$createBlogForm.on('submit', async e => {
      e.preventDefault();

      const createBlogFormData = new FormData(this.$createBlogForm[0]);

      const newBlog = { content: createBlogFormData.get('blog-content') };

      await this.disableCreateButton(newBlog);

      callback(newBlog).finally(async () => {
        await this.enableCreateButton();
      });
    });
  }

  async getBlogId(callback) {
    $(document).on('click', '.js-edit-blog, .js-delete-blog', async e => {
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
    $(document).on('submit', '#updateBlogForm', function (e) {
      e.preventDefault();

      const updateBlogFormData = new FormData(e.currentTarget);

      const blogId = updateBlogFormData.get('blog-id');
      const updatedContent = updateBlogFormData.get('updated-content');

      callback({ blogId, data: { updatedContent } });
    });
  }
}
