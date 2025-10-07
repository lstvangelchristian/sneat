<x-modal-component
  id="getCommentsModal"
  label="getCommentsModalLabel"
  title="COMMENTS"
>

  <div class="modal-body" style="height: 400px; overflow-y: auto;">
    @foreach ($comments as $comment)
      <div class="shadow-sm border p-3 mb-3">
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
        <div class="shadow-sm border p-3">
          {{ $comment->content }}
        </div>
      </div>
    @endforeach
  </div>

</x-modal-component>
