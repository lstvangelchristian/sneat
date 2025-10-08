<form id="updateCommentForm">
  <input type="hidden" name="comment-id" value="{{ $comment->id }}" />
  <input type="hidden" name="blog-id" value="{{ $comment->blog_id }}" />
  <textarea class="form-control" name="updated-content" rows="5" style="resize: none">{{ $comment->content }}</textarea>

  <div class="text-end mt-3">
    <button type="button" data-blog-id="{{ $comment->blog_id }}" class="btn btn-danger btn-sm js-cancel-edit-comment">Cancel</button>
    <button type="submit" id="confirm-button" type="button" class="btn btn-primary btn-sm">Save</button>
  </div>
</form>
