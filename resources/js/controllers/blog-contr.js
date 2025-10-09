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
        const res = await this.model.createBlog(newBlog);

        if (res.success) {
          const updatedBlogs = await this.model.renderBlogs();
          await this.view.renderBlogs(updatedBlogs);

          this.showResult({
            title: res.message,
            text: 'Click the button to close',
            icon: 'success'
          });
        }
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
        const res = await this.model.renderUpdateModal(data.blogId);
        await this.view.renderModal(res);
      } catch (errors) {
        this.showResult({
          title: errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.updateBlog(async data => {
      try {
        const res = await this.model.updateBlog(data);

        if (res.success) {
          const updatedContent = await this.model.renderBlogs();
          await this.view.renderBlogs(updatedContent);

          await this.view.hideModal('#updateBlogModal');

          this.showResult({
            title: res.message,
            text: 'Click the button to close',
            icon: 'success'
          });
        }
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
              const res = await this.model.deleteBlog(deleteData.blogId);

              if (res.success) {
                const updatedContent = await this.model.renderBlogs();
                await this.view.renderBlogs(updatedContent);
              }
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
      } catch (errors) {
        this.showResult({
          title: errors.blog_id[0] || errors.type_id[0] || errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.showReaction(async id => {
      try {
        const result = await this.model.getReactions(id);
        await this.view.renderReactionModal(result);
      } catch (errors) {
        this.showResult({
          title: errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.getCreateCommentContent(async comment => {
      if (comment.isClicked) {
        try {
          const content = await this.model.getCreateCommentContent(comment.blogId);
          await this.view.renderCreateCommentContent(content);
        } catch (errors) {
          console.log(errors);
          this.showResult({
            title: errors.exception[0],
            text: 'Click the button to close',
            icon: 'error'
          });
        }
      }
    });

    await this.view.createComment(async commentData => {
      try {
        const res = await this.model.createComment(commentData);

        if (res.success) {
          await this.view.hideModal('#createCommentModal');

          const updatedContent = await this.model.renderBlogs();
          await this.view.renderBlogs(updatedContent);

          this.showResult({
            title: res.message,
            text: 'Click the button to close',
            icon: 'success'
          });
        }
      } catch (errors) {
        this.showResult({
          title: errors.content[0] || errors.blogId[0] || errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.showComments(async blogId => {
      try {
        const result = await this.model.renderComments(blogId);
        await this.view.renderCommentContent(result);
      } catch (errors) {
        console.log(errors);
        this.showResult({
          title: errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.editComment(async editData => {
      try {
        const result = await this.model.getComment(editData.commentId);
        await this.view.showEditableComment(result);
      } catch (errors) {
        console.log(errors);
        this.showResult({
          title: errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.cancelEditComment(async blogId => {
      try {
        if (blogId) {
          const content = await this.model.loadComments(blogId);
          await this.view.loadComments(content);
        }
      } catch (errors) {
        console.log(errors);
        this.showResult({
          title: errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.updateComment(async (updateCommentData, blogId) => {
      try {
        const res = await this.model.updateComment(updateCommentData);
        if (res.success) {
          const content = await this.model.loadComments(blogId);
          await this.view.loadComments(content);
        }
      } catch (errors) {
        console.log(errors);
        this.showResult({
          title: errors.updatedComment[0] || errors.commentId[0] || errors.exception[0],
          text: 'Click the button to close',
          icon: 'error'
        });
      }
    });

    await this.view.showDeleteConfirmation(async retrieveId => {
      if (retrieveId) {
        this.confirmDeletion({
          title: 'comment',
          onConfirmDelete: async () => {
            try {
              const res = await this.model.deleteComment(retrieveId.commentId);

              if (res.success) {
                const content = await this.model.loadComments(retrieveId.blogId);
                await this.view.loadComments(content);

                const updatedContent = await this.model.renderBlogs();
                await this.view.renderBlogs(updatedContent);
              }
            } catch (errors) {
              console.log(errors);
              this.showResult({
                title: errors.exception[0],
                text: 'Click the button to close',
                icon: 'error'
              });
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

        await this.view.updateRepliesCount({ isDelete: false, commentId: retrieveNewReply.commentId });
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

              await this.view.updateRepliesCount({ isDelete: true, commentId: deleteData.commentId });
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
