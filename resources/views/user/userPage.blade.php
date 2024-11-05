@extends('layouts.userLayout')

@section('title','News')
    
@section('content')
    
    <!-- Page Title -->
      <div class="page-title dark-background">
        <div class="container position-relative">
          <h1>News</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="/user-page">Home</a></li>
              <li class="current">Posts</li>
            </ol>
          </nav>
        </div>
      </div>
    <!-- End Page Title -->
  
      <!-- Blog Posts Section -->
        <section id="blog-posts" class="blog-posts section">
    
          <div class="container">
            <div class="row gy-4">
    
              @foreach ($posts as $item)
                <div class="col-lg-4">
                  <article>
      
                    {{-- <div class="post-img">
                      <img src="{{ asset('storage/app/public/' . $item->image_path) }}" alt="" class="img-fluid">
                  </div>
                  --}}

                  <div class="post-img">
                      <img src="{{ $item->image_path }}" alt="" class="img-fluid">
                  </div> 
                    <p class="post-category"></p>
      
                    <h2 class="title">
                      <a href="{{ url('/post-details', ['id' => $item->id]) }}">{{ $item->title }}</a>
                    </h2>
                  
                    <div class="d-flex align-items-center">
                      <div class="post-meta">
                        <p>{{$item->description}}</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">{{$item->created_at}}</time>
                        </p>
                      </div>
                    </div>
      
                  </article>
                </div><!-- End post list item -->
              @endforeach
            </div>
          </div>
    
        </section>
      <!-- /Blog Posts Section -->
  
      <!-- Blog Pagination Section -->
        <section id="blog-pagination" class="blog-pagination section">
    
          <div class="container">
            <div class="d-flex justify-content-center">
              {{ $posts->links() }}
          </div>
    
        </section>
      <!-- /Blog Pagination Section -->
  
@endsection