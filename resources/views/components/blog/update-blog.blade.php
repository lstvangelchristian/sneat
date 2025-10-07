<x-modal-component
  id="updateBlogModal"
  label="updateBlogModalLabel"
  title="UPDATE BLOG"
  formId="updateBlogForm"
>
  <div>
    <input type="hidden" name="blog-id" value="{{ $blog->id }}" />
    <textarea rows="5" name="updated-content" class="form-control" style="resize: none">{{ $blog->content }}</textarea>
  </div>

  <x-slot name="footer">
    <x-modal-footer-component />
  </x-slot>
</x-modal-component>
