<x-modal-component
  id="getCommentsModal"
  label="getCommentsModalLabel"
  title="COMMENTS"
  size="modal-lg"
>

  <div class="modal-body comments-container" style="height: 600px; overflow-y: auto;">
    @if($comments->count() === 0)
      <div class="text-center p-3">No Comments Yet</div>
    @else
      @foreach ($comments as $comment)
        <div class="shadow-sm border p-3 mb-3">
          @if ($comment->user_id === Auth::guard('author')->user()->id)
            <div class="text-end">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item js-edit-comment" data-blog-id="{{ $comment->blog_id }}" data-comment-id="{{ $comment->id }}" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i>Edit</a>
                  <a class="dropdown-item js-delete-comment" data-comment-id="{{ $comment->id }}" data-blog-id="{{ $comment->blog_id }}" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i>Delete</a>
                </div>
              </div>
            </div>
          @endif

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h5 class="m-0">
                {{ strtoupper($comment->user->username) }}
              </h5>
            </div>
            <div>
              {{ $comment->created_at }}
            </div>
          </div>

          <div class="shadow-sm border p-3 js-comment-{{ $comment->id }}">
            {{ $comment->content }}
          </div>

          <div class="d-flex mt-3">
            <p class="m-0 js-show-replies text-primary" style="cursor: pointer;" data-comment-id="{{ $comment->id }}">Replies: {{ $comment->replies->count() }}</p>
          </div>

          <div class="js-replies-container-{{ $comment->id }}">

          </div>
        </div>
      @endforeach
    @endif
  </div>

</x-modal-component>
