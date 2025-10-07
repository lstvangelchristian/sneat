<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $label }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center w-100" id="{{ $label }}">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="{{ $formId }}" method="post">
        <div class="modal-body">
          {{ $slot }}
        </div>

        <div class="modal-footer">
          {{ $footer }}
        </div>
      </form>
    </div>
  </div>
</div>
