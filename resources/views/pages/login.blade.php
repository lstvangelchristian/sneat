@extends('layouts.auth')

@section('content')
  <h4 class="text-center">
    LOGIN
  </h4>

  <form id="login-form" method="POST">
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

    <div class="credential-error error"></div>

    <div class="exception-error error"></div>

    <div class="mb-3">
        <x-save-button>
          Login
        </x-save-button>
    </div>

    <div class="text-center">
      <x-a href="{{ route('show-register') }}">
        Create an account
      </x-a>
    </div>
  </form>
@endsection

@push('scripts')
  @vite('resources/js/main/login-main.js')
@endpush
