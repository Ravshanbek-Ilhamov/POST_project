@extends('layouts.userLayout')

@section('title','News')
    
@section('content')
    
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container position-relative">
          <h1>Post Details</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="/user-page">Home</a></li>
              <li class="current">Post Details</li>
            </ol>
          </nav>
        </div>
    </div><!-- End Page Title -->
  
      <div class="container">
        <div class="row">
  
          <div class="col-lg-8">
  
            <!-- Blog Details Section -->
            <section id="blog-details" class="blog-details section">
              <div class="container">
  

                <article class="article">

                  <div class="card" style="width: 100%; height: 300px; overflow: hidden;">
                    <img src="{{ $post->image_path }}" alt="Card Image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                
              
                  <h2 class="title">{{$post->title}}</h2>
  
                  <div class="meta-top">
                    <ul>
                      <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a href="#">{{$post->number_view}}</a></li>
                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">{{$post->created_at}}</time></a></li>
                      <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#">{{$post->comments->count()}}</a></li>
                      <ul style="list-style: none; display: flex; gap: 20px;">
                        <!-- Like Button -->
                        <br>
                    </ul>
                    
                    </ul>
                  </div><!-- End meta top -->
  
                  <div class="content">
                    <p>
                      {{$post->description}}
                    </p>
  
                    <p>
                      {{$post->text}}
                    </p>
                    <img src="assets/img/blog/blog-inside-post.jpg" class="img-fluid" alt="">
                    @if (auth()->check())
                      <ul style="list-style: none; display: flex; gap: 20px;">
                        <!-- Like Button -->
                        <li>
                          <form action="/LikeReaction" method="POST">
                            @csrf
                            <input type="hidden" name="reaction" value="like">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                      
                            <button 
                              id="like" 
                              class="{{ $hasLiked ? 'btn btn-primary' : 'btn btn-outline-primary' }}">
                              <i class="bi bi-hand-thumbs-up-fill me-1"></i>
                            </button>
                            <label>{{ $post->likes }}</label>
                          </form>
                        </li>
                      
                        <!-- Dislike Button -->
                        <li>
                          <form action="/DislikeReaction" method="POST">
                            @csrf
                            <input type="hidden" name="reaction" value="dislike">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                      
                            <button 
                              id="dislike" 
                              class="{{ $hasDisliked ? 'btn btn-primary' : 'btn btn-outline-primary' }}">
                              <i class="bi bi-hand-thumbs-down-fill me-1"></i>
                            </button>
                            <label>{{ $post->dislikes }}</label>
                          </form>
                        </li>
                      </ul>
                    @endif
                    
                  </div><!-- End post content -->
  
                  <div class="meta-bottom">
                    <i class="bi bi-folder"></i>
                    <ul class="cats">
                      <li><a href="#">Business</a></li>
                    </ul>
  
                    <i class="bi bi-tags"></i>
                    <ul class="tags">
                      <li><a href="#">Creative</a></li>
                      <li><a href="#">Tips</a></li>
                      <li><a href="#">Marketing</a></li>
                    </ul>
                  </div><!-- End meta bottom -->
  
                </article>
  
              </div>
            </section><!-- /Blog Details Section -->

            <!-- Comment Form Section -->
            <section id="comment-form" class="comment-form section">
              <div class="container">
  
                
                <h4>Post Comment</h4>
                @if (auth()->check())
                <form action="/comment_creation" method="POST">
                <p>Your email address will not be published. Required fields are marked * </p>
                @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="row">
                      <div class="col form-group">
                        <textarea name="text" class="form-control" placeholder="Your Comment*"></textarea>
                      </div>
                    </div>
    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Post Comment</button>
                    </div>
                      
                  </form>
                  @else
                    <p>Please Login Or Register For Posting a Comment * </p>

                    <a href="/">Login</a>
                    <a href="/registeration">Register</a>

                  @endif

  
  
              </div>
            </section>
            <!-- /Comment Form Section -->
   
          </div>
  
          <div class="col-lg-4 sidebar">
            <!-- Blog Comments Section -->
            <section id="blog-comments" class="blog-comments section mt-5">
              <div class="container">
                  <h4 class="comments-count">{{ $comments->count() }} Comments</h4>

                  @foreach ($comments as $item)
                      <div id="comment-{{ $item->id }}" class="comment">
                          <div class="d-flex">
                              <div class="comment-img"><img src="assets/img/blog/comments-1.jpg" alt=""></div>
                              <div>
                                  <h5><a href="">{{ $item->user->name }}</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                  <time datetime="{{ $item->created_at }}">{{ $item->created_at->format('Y-m-d H:i') }}</time>
                                  <p>{{ $item->text }}</p>
                              </div>
                          </div>
                      </div><!-- End comment #{{ $item->id }} -->
                  @endforeach

                  <!-- Pagination Links -->
                  <div class="pagination">
                      {{ $comments->links() }} <!-- This will render pagination links -->
                  </div>
              </div>
            </section><!-- /Blog Comments Section -->


          </div>
  
        </div>
      </div>
      {{-- <script>
        function submitReaction(postId, reactionType) {
            fetch('{{ route('reaction.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    post_id: postId,
                    reaction: reactionType
                })
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector(`a[onclick="submitReaction(${postId}, 'like')"]`).textContent = data.likes;
                document.querySelector(`a[onclick="submitReaction(${postId}, 'dislike')"]`).textContent = data.dislikes;
            })
            .catch(error => console.error('Error:', error));
        }
    </script> --}}
    
    
@endsection