<x-modal-component
  id="getReactionModal"
  label="getReactionModalLabel"
  title="Reactions"
>

<div class="modal-body" style="height: 400px; overflow-y: auto;">
  @if ($reactions->count() === 0)
    <div class="text-center p-3">No Reactions Yet</div>
  @else
    @foreach ($reactions as $reaction)
      <div class="shadow-sm border p-3 mb-3">
        <div class="d-flex align-items-center">
          <div class="me-3">
            <img src="{{ asset('images/reactions/'. $reaction->type_id .'.png') }}" class="me-2" style="width: 40px;"/>
          </div>

          <div>
            <h5 class="m-0">{{ strtoupper($reaction->user->username) }}</h5>
            <p class="m-0">Author</p>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>

</x-modal-component>
