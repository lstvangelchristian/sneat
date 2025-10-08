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

        const updatedContent = await this.model.renderBlogs();
        await this.view.renderBlogs(updatedContent);

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

        const updatedContent = await this.model.renderBlogs();
        await this.view.renderBlogs(updatedContent);

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
              const updatedContent = await this.model.renderBlogs();
              await this.view.renderBlogs(updatedContent);
            } catch (errors) {
              return;
            }
          }
        });
      }
    });

    await this.view.createReact(async reactionData => {
      try {
        await this.model.createReaction(reactionData);
        const updatedContent = await this.model.renderBlogs();
        await this.view.renderBlogs(updatedContent);
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
        const updatedContent = await this.model.renderBlogs();
        await this.view.renderBlogs(updatedContent);

        this.showResult({
          title: 'Your comment has been submitted successfully',
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

    await this.view.editComment(async editData => {
      try {
        const result = await this.model.getComment(editData.commentId);
        await this.view.showEditableComment(result);
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.cancelEditComment(async blogId => {
      try {
        if (blogId) {
          const content = await this.model.loadComments(blogId);
          await this.view.loadComments(content);
        }
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.updateComment(async (updateCommentData, blogId) => {
      try {
        const result = await this.model.updateComment(updateCommentData);
        console.log(result);

        const content = await this.model.loadComments(blogId);
        await this.view.loadComments(content);
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.showDeleteConfirmation(async retrieveId => {
      console.log(retrieveId);

      if (retrieveId) {
        this.confirmDeletion({
          title: 'comment',
          onConfirmDelete: async () => {
            try {
              await this.model.deleteComment(retrieveId.commentId);

              const content = await this.model.loadComments(retrieveId.blogId);
              await this.view.loadComments(content);

              const updatedContent = await this.model.renderBlogs();
              await this.view.renderBlogs(updatedContent);
            } catch (errors) {
              return;
            }
          }
        });
      }
    });

    await this.view.showReplies(async commentId => {
      try {
        const result = await this.model.getReplies(commentId);
        console.log(result);
        await this.view.renderReplies(result);
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.createReply(async retrieveNewReply => {
      try {
        const result = await this.model.createReply(retrieveNewReply);

        const updatedReplies = await this.model.getReplies(retrieveNewReply.commentId);
        await this.view.renderReplies(updatedReplies);
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.retrieveReplyData(async replyData => {
      try {
        const res = await this.model.getReply(replyData.replyId);
        await this.view.makeReplyContentEditable(res);
      } catch (e) {
        console.log(e);
        console.log('haserrors');
      }
    });

    await this.view.cancelEditReply(async commentId => {
      try {
        if (commentId) {
          const updatedReplies = await this.model.getReplies(commentId);
          await this.view.renderReplies(updatedReplies);
        }
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.updateReply(async (updateReplyData, commentId) => {
      try {
        const result = await this.model.updateReply(updateReplyData);
        console.log(result);
        const updatedReplies = await this.model.getReplies(commentId);
        await this.view.renderReplies(updatedReplies);
      } catch (e) {
        console.log(e);
      }
    });

    await this.view.deleteReply(async deleteData => {
      if (deleteData) {
        this.confirmDeletion({
          title: 'reply',
          onConfirmDelete: async () => {
            try {
              const res = await this.model.deleteReply(deleteData.replyId);

              const updatedReplies = await this.model.getReplies(deleteData.commentId);
              await this.view.renderReplies(updatedReplies);

              const updatedContent = await this.model.renderBlogs();
              await this.view.renderBlogs(updatedContent);
            } catch (errors) {
              console.log(errors);
              return;
            }
          }
        });
      }
    });
  }
}
