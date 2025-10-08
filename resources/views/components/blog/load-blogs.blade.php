<h5 class="m-0 mt-3">
  PUBLIC FEED
</h5>

<div class="mb-3">
  @foreach ($blogs as $blog)
    <div class="shadow-sm border p-3 mb-3">

      @if ($blog->author_id === Auth::guard('author')->user()->id)
        <div class="text-end">
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
              <a class="dropdown-item js-edit-blog" data-blog-id="{{ $blog->id }}" data-blog-action="edit" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i>Edit</a>
              <a class="dropdown-item js-delete-blog" data-blog-id="{{ $blog->id }}" data-blog-action="delete" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i>Delete</a>
            </div>
          </div>
        </div>
      @endif

      <div class="d-flex justify-content-between align-items-center">

        <div class="d-flex justify-content-center align-items-center mt-3">
          <div class="bg-primary d-flex justify-content-center align-items-center me-3" style="height: 50px; width: 50px; border-radius: 100%;">
            <h5 class="m-0" style="color: white">
              {{ strtoupper(substr($blog->author->username, 0, 1)) }}
            </h5>
          </div>

          <div>
            <h5 class="m-0">
              {{ strtoupper($blog->author->username) }}
            </h5>
            <p class="m-0">
              Author
            </p>
          </div>
        </div>

        <div>
          <p class="m-0">
            {{ $blog->created_at }}
          </p>
        </div>

      </div>

      <div class="shadow-sm p-3 mt-3 js-blog-content-container-{{ $blog->id }}" style="border: 1px solid lightgray;">
        {{ $blog->content }}
      </div>

      <div class="d-flex align-items-center justify-content-between mt-3">
        <div class="d-flex align-items-center show-reaction" data-blog-id="{{ $blog->id }}" style="cursor: pointer;">
          @php
            $userReaction = $blog->reactions->firstWhere('user_id', Auth::guard('author')->user()->id);
          @endphp

          @if ($userReaction)
            <img src="{{ asset('images/reactions/'. $userReaction->type_id .'.png') }}" class="me-2" style="width: 20px;"/>
          @endif

          <span>Reactions: {{ $blog->reactions->count() }}</span>
        </div>

        <div class="show-comments" data-blog-id="{{ $blog->id }}" style="cursor: pointer;">
          <span class="me-2">Comments: {{ $blog->comments->count() }}</span>
          <img src="{{ asset('images/comment.png') }}" style="width: 20px;"/>
        </div>
      </div>

      <div class="d-flex align-items-center justify-content-between mt-3">
        <div class="w-100 text-center reaction-container" data-blog-id="{{ $blog->id }}">
          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="1">
            <x-img-reaction src="{{ asset('images/reactions/1.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="2">
            <x-img-reaction src="{{ asset('images/reactions/2.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="3">
            <x-img-reaction src="{{ asset('images/reactions/3.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="4">
            <x-img-reaction src="{{ asset('images/reactions/4.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="5">
            <x-img-reaction src="{{ asset('images/reactions/5.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="6">
            <x-img-reaction src="{{ asset('images/reactions/6.png') }}" />
          </button>

          <button class="border border-transparent bg-transparent react-btn" data-reaction-id="7">
            <x-img-reaction src="{{ asset('images/reactions/7.png') }}" />
          </button>
        </div>

        <div class="w-100 text-center">
          <button class="border border-transparent bg-transparent comment-btn" data-blog-id="{{ $blog->id }}">
            <x-img-reaction src="{{ asset('images/comment.png') }}" />
          </button>
        </div>
      </div>

    </div>
  @endforeach
</div>
