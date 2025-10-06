<x-layouts.auth>

  <h4 class="text-center">
    REGISTER
  </h4>

  <form id="registration-form" method="POST">
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

    <x-reusable.input
      type="password"
      name="confirm-password"
      floatingInput="confirm-password"
      placeholder="Enter your password again"
      label="Confirm Password"
    />

    <div class="confirmPassword-error error"></div>

    <div class="catch-error error"></div>

    <div class="mb-3">
        <x-reusable.save-button>
          Register
        </x-reusable.save-button>
    </div>

    <div class="text-center">
      <x-reusable.a href="{{ route('show-login') }}">
        Already have an account?
      </x-reusable.a>
    </div>
  </form>

  <x-pages.auth-pages.auth-pages-scripts.register-script />

</x-layouts.auth>
