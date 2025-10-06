<x-layouts.auth>

  <h4 class="text-center">
    LOGIN
  </h4>

  <form id="login-form" method="POST">
    <x-reusable.input
      type="text"
      name="username"
      floatingInput="username"
      placeholder="Enter your username"
      label="Username"
    />

    <div class="username-error error"></div>

    <x-reusable.input
      type="password"
      name="password"
      floatingInput="password"
      placeholder="Enter your password"
      label="Password"
    />

    <div class="password-error error"></div>

    <div class="catch-error error"></div>

    <div class="mb-3">
        <x-reusable.save-button>
          Login
        </x-reusable.save-button>
    </div>

    <div class="text-center">
      <x-reusable.a href="{{ route('show-register') }}">
        Create an account
      </x-reusable.a>
    </div>
  </form>

  <x-pages.auth-pages.auth-pages-scripts.login-script />

</x-layouts.auth>
