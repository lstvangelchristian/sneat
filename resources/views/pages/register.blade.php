@extends('layouts.auth')

@section('content')
  <h4 class="text-center">
    REGISTER
  </h4>

  <form id="registration-form" method="post">
    <x-input
      type="text"
      name="username"
      floatingInput="username"
      placeholder="Enter your username"
      label="Username"
    />

    <div class="username-error error"></div>

    <x-input
      type="password"
      name="password"
      floatingInput="password"
      placeholder="Enter your password"
      label="Password"
    />

    <div class="password-error error"></div>

    <x-input
      type="password"
      name="confirm-password"
      floatingInput="confirm-password"
      placeholder="Enter your password again"
      label="Confirm Password"
    />

    <div class="confirmPassword-error error"></div>

    <div class="exception-error error"></div>

    <div class="mb-3">
        <x-save-button>
          Register
        </x-save-button>
    </div>

    <div class="text-center">
      <x-a href="{{ route('show-login') }}">
        Already have an account?
      </x-a>
    </div>
  </form>
@endsection

@push('scripts')
  @vite('resources/js/main/register-main.js')
@endpush
