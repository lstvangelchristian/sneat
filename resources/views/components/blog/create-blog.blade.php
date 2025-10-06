<h5 class="m-0 mt-3">
  CREATE BLOG
</h5>

<div class="shadow-sm border p-3 mt-3">
  <form id="create-blog-form">
    <div class="d-flex justify-content-center">
      <div class="d-flex align-items-center justify-content-center bg-primary me-3" style="height: 50px; width: 50px; border-radius: 100%; ">
        <h5 class="m-0" style="color: white">
          {{ strtoupper(substr(Auth::guard('author')->user()->username, 0, 1)) }}
        </h5>
      </div>
      <textarea class="form-control create-blog-field" name="blog-content" rows="1" placeholder="What's on your mind?" style="resize: none;"></textarea>
    </div>

    <div class="text-end mt-3">
      <x-save-button>
        Post
      </x-save-button>
    </div>
  </form>
</div>
