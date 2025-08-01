@extends('layouts.frontend')


@section('title')
    Blogs
@endsection

@section('head')
<style>
    .blog-grid__item {
    position: relative;
    overflow: hidden;
}

.stretched-link {
    position: absolute;
    inset: 0;
    z-index: 1;
    text-indent: -9999px;
    overflow: hidden;
    white-space: nowrap;
    pointer-events: auto;
}

</style>
@endsection

@section('content')
    <main>
        <section class="blog-page-title mb-4 mb-xl-5">
            <div class="title-bg">
                <img loading="lazy" src="{{ url($banner->image) }}" width="1780" height="420" alt="">
            </div>
            <div class="container">
                <h2 class="page-title">Blogs</h2>

                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                    <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                    <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Blogs</a>
                </div><!-- /.breadcrumb -->
            </div>
        </section>
       <section class="blog-page container">
    <h2 class="d-none">Our Blogs</h2>
    <div class="blog-grid row row-cols-1 row-cols-md-2 row-cols-xl-3">
        @foreach ($blogs as $blog)
            <div class="blog-grid__item position-relative">
                <a href="{{ url('blogs/'.$blog->slug) }}" class="stretched-link"></a>

                <div class="blog-grid__item-image">
                    <img loading="lazy" class="h-auto" src="{{ url($blog->main_image) }}" width="450"
                        height="400" alt="">
                </div>
                <div class="blog-grid__item-detail">
                    <div class="blog-grid__item-title">
                        {{ \Illuminate\Support\Str::limit($blog->title, 50) }}
                        <br><br>
                        <span class="readmore-link"><u>Continue Reading</u></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $blogs->links('partial.custom_pagination') }}
</section>

    </main>
@endsection
