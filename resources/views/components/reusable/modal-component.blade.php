<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    {{ $button }}
</button>

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $label }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $label }}">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @foreach ($blogs as $blog)
          <div>
            {{ $blog->id }}
            {{ $blog->content }}
            {{ $blog->author }}
            {{ $blog->created_at }}
          </div>
        @endforeach
      </div>

      <div class="modal-footer">
        {{ $footer }}
      </div>
    </div>
  </div>
</div>
