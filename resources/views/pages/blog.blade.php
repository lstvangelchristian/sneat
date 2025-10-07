@extends('layouts.app')

@section('content')
  <div class="overflow-auto vh-100">
    <x-blog.create-blog />

    <x-blog.get-blogs :blogs="$blogs"/>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/main/blog-main.js')
@endpush
