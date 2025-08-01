@extends('layouts.frontend')

@section('title')
    {{ $policy->title }}
@endsection

@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="blog-page blog-single container">
            {!! $policy->content !!}
    </section>
  </main>

@endsection
