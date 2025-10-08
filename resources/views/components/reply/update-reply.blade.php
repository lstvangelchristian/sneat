<form id="updateReplyForm" method="post">
  <input type="hidden" name="comment-id" value="{{ $reply->comment_id }}" />
  <input type="hidden" name="reply-id" value="{{ $reply->id }}" />
  <textarea class="form-control" name="updated-reply" rows="5" style="resize: none">{{ $reply->content }}</textarea>

  <div class="text-end mt-3">
    <button type="button" class="btn btn-danger btn-sm js-cancel-reply" data-comment-id="{{ $reply->comment_id }}">Cancel</button>
    <button type="submit" type="button" class="btn btn-primary btn-sm">Save</button>
  </div>
</form>
