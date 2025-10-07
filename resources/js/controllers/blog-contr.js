export class BlogContr {
  constructor(model, view, showResult) {
    this.model = model;
    this.view = view;
    this.showResult = showResult;
  }

  async init() {
    await this.view.makeBlogFieldResize();

    await this.view.createBlog(async newBlog => {
      try {
        await this.model.createBlog(newBlog);

        this.showResult({
          title: 'Your blog has been posted successfully',
          text: 'Click the button to close',
          icon: 'success'
        });
      } catch (errors) {
        this.showResult({
          title: errors.content[0] || errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.getBlogId(async data => {
      try {
        const result = await this.model.renderUpdateModal(data.blogId);
        await this.view.renderModal(result);
      } catch (error) {
        console.log(error);
      }
    });

    await this.view.updateBlog(async data => {
      try {
        const result = await this.model.updateBlog(data);
        console.log(result);
      } catch (error) {
        console.log(error);
      }
    });
  }
}
