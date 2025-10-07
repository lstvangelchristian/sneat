export class BlogContr {
  constructor(model, view, showResult, confirmDeletion) {
    this.model = model;
    this.view = view;
    this.showResult = showResult;
    this.confirmDeletion = confirmDeletion;
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
        await this.model.updateBlog(data);

        await this.view.hideModal('#updateBlogModal');
        this.showResult({
          title: 'Your blog has been posted successfully',
          text: 'Click the button to close',
          icon: 'success'
        });
      } catch (errors) {
        console.log(errors);
        this.showResult({
          title: errors.updatedContent[0] || errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.deleteBlog(async deleteData => {
      if (deleteData.isClicked) {
        this.confirmDeletion({
          title: 'blog',
          onConfirmDelete: async () => {
            try {
              await this.model.deleteBlog(deleteData.blogId);
            } catch (errors) {
              return;
            }
          }
        });
      }
    });

    await this.view.createReact(async reactionData => {
      try {
        const result = await this.model.createReaction(reactionData);
        console.log(result);
      } catch (error) {
        console.log(error);
      }
    });

    await this.view.showReaction(async id => {
      try {
        const result = await this.model.getReactions(id);
        await this.view.renderReactionModal(result);
      } catch (error) {
        console.log(error);
      }
    });

    await this.view.getCreateCommentContent(async comment => {
      if (comment.isClicked) {
        try {
          const content = await this.model.getCreateCommentContent(comment.blogId);
          await this.view.renderCreateCommentContent(content);
        } catch (e) {
          console.log(e);
        }
      }
    });

    await this.view.createComment(async commentData => {
      try {
        const res = await this.model.createComment(commentData);
        await this.view.hideModal('#createCommentModal');
        this.showResult({
          title: 'Your blog has been posted successfully',
          text: 'Click the button to close',
          icon: 'success'
        });
      } catch (error) {
        console.log(res);
      }
    });

    await this.view.showComments(async blogId => {
      try {
        const result = await this.model.renderComments(blogId);
        await this.view.renderCommentContent(result);
      } catch (e) {
        console.log(e);
      }
    });
  }
}
