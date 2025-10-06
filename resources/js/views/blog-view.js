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
}
