@extends('layouts.app')

@section('content')
  <x-blog.create-blog />
@endsection

@push('scripts')
  @vite('resources/js/main/blog-main.js')
@endpush
