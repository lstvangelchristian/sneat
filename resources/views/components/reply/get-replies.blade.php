<div class="shadow-sm border bg-light text-center p-1 text-light mt-3">
  <h6 class="m-0">Replies</h6>
</div>
<div class="shadow-sm border p-3">
  <div>
    @if ($replies->count() === 0)
      <p class="text-center m-0">No Replies Yet</p>
    @else
    <div class="overflow-auto" style="height: 200px;">
      @foreach ($replies as $reply)
          <div class="shadow-sm border p-3 mb-3">

            @if ($reply->user_id === Auth::guard('author')->user()->id)
              <div class="text-end">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item js-edit-reply" data-reply-id="{{ $reply->id }}" data-comment-id="{{ $reply->comment_id }}" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i>Edit</a>
                    <a class="dropdown-item js-delete-reply" data-reply-id="{{ $reply->id }}" data-comment-id="{{ $reply->comment_id }}" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i>Delete</a>
                  </div>
                </div>
              </div>
            @endif

            <div class="d-flex align-items-center justify-content-between mb-1">
              <div>
                <h6 class="m-0">{{ strtoupper($reply->authors->username) }}</h6>
              </div>

              <div>
                <p class="m-0">{{$reply->created_at}}</p>
              </div>
            </div>

            <div class="shadow-sm border p-3">
              <p class="m-0">{{$reply->content}}</p>
            </div>
          </div>
      @endforeach
    </div>
    @endif
  </div>

  <div class="mt-3">
    <form id="createReplyForm" method="post">
      <input name="comment-id" type="hidden" value="{{ $commentId }}" />
      <textarea name="content" class="form-control border resize-none" rows="1" placeholder="Write a reply..."></textarea>
      <div class="text-end">
        <button type="submit" class="btn btn-primary form-control btn-sm mt-1">Reply</button>
      </div>
    </form>
  </div>
</div>
