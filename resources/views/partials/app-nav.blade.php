<div class="text-center my-5">
  <h3 class="m-0">
    WRITE
  </h3>

  <p class="m-0">
    Full of stories, full of joy
  </p>
</div>

<div class="d-flex justify-content-center align-items-center my-5">
  <div class="bg-primary d-flex justify-content-center align-items-center me-3" style="height: 50px; width: 50px; border-radius: 100%;">
    <h5 class="m-0" style="color: white;">
      {{ strtoupper(substr(Auth::guard('author')->user()->username, 0, 1)) }}
    </h5>
  </div>

  <div>
    <h5 class="m-0">
      {{ strtoupper(Auth::guard('author')->user()->username) }}
    </h5>
    <p class="m-0">
      Author
    </p>
  </div>
</div>

<div class="my-5">
  <div class="mt-5">
    <x-reusable.a href="{{ route('show-blog') }}">
      Blogs
    </x-reusable.a>
  </div>

  <div class="mt-5">
    <x-reusable.a href="#">
      Account Management
    </x-reusable.a>
  </div>
</div>

<div class="flex-grow-1"></div>

<form id="logout-form" class="mb-3">
  <x-reusable.save-button>
    Logout
  </x-reusable.save-button>
</form>

<x-partials.partials-script.app-nav-script />
