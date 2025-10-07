<x-modal-component
  id="updateBlogModal"
  label="updateBlogModalLabel"
  title="UPDATE BLOG"
>
  <form id="updateBlogForm" method="post">
    <div class="modal-body">
      <input type="hidden" name="blog-id" value="{{ $blog->id }}" />
      <textarea rows="5" name="updated-content" class="form-control" style="resize: none">{{ $blog->content }}</textarea>
    </div>

    <x-modal-footer-component />
  </form>

</x-modal-component>
