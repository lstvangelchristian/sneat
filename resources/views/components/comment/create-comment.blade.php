<x-modal-component
  id="createCommentModal"
  label="createCommentModalLabel"
  title="CREATE COMMENT"
>
  <form id="createCommentForm" method="post">
    <div class="modal-body">
      <input type="hidden" name="blog-id" value="{{ $blogId }}" />
      <textarea rows="5" name="content" class="form-control" placeholder="Write a comment..." style="resize: none"></textarea>
    </div>

    <x-modal-footer-component />
  </form>

</x-modal-component>
