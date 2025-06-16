@include('components.userNavigationButtons')
@include('components.splineBackground')
{{-- <div id="new-gym-thread" class="user-post-container">
    <div class="user-post-content">
        <div class="user-post-upper">
            <button>Cancel</button>
            <p>New GymThread</p>
            <button>Drafts</button>
        </div>
        <span class="user-post-divider"></span>
        <div class="user-post-lower">
            <div class="post-content-user">
                <div class="user-profile-pic">
                    <img src="https://m.media-amazon.com/images/I/61e-cD4efFL._AC_SX522_.jpg" alt="">
                </div>
                <div class="post-content-inner">
                    <div class="post-content-inner-header">
                        <h4>{{ auth()->user()->name }}</h4>
                    </div>
                    <form action="">
                        <p>Start typing...</p>
                        <button>Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-centered">
    <navbar>
        <a class="navbar-title-link" href="/">
            <h1 class="navbar-title">GymThreads</h1>
        </a>
        <div class="navbar-info">
            <p>
                <a href="/" title="Profile">{{ auth()->user()->name }}</a> logged in
            </p>
        </div>
    </navbar>
    <div class="create-post-container">
        <h2>Create a new post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <textarea id="autogrow" name="body" placeholder="Start typing..."></textarea>
            <button>Save Post</button>
        </form>
    </div>
    {{-- Everyones posts --}}
    <div class="seperator">
        <h2>Feed</h2>
    </div>
    <div class="post-container">
        @foreach ($otherPosts as $post)
            <div class="post">
                <div class="post-content">
                    <div class="user-profile-pic">
                        <img src="https://m.media-amazon.com/images/I/61e-cD4efFL._AC_SX522_.jpg" alt="">
                    </div>
                    <div class="post-content-inner">
                        <div class="post-content-inner-header">
                            <h4>{{ $post->user->name }}</h4>
                            <p>&nbsp;&nbsp;{{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                        <p>{{ $post['body'] }}</p>
                        <div class="post-actions">
                            {{-- conditional css here with the ternary operator --}}
                            <button class="like-btn{{ $post->likedBy(auth()->user()) ? ' liked' : '' }}"
                                data-post-id="{{ $post->id }}"
                                data-liked="{{ $post->likedBy(auth()->user()) ? '1' : '0' }}">
                                <span class="like-icon">
                                    @if ($post->likedBy(auth()->user()))
                                        <!-- Heroicon: Heart Solid -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ff4757" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#ff4757" class="icon-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    @else
                                        <!-- Heroicon: Heart Outline -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#686868" class="icon-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    @endif
                                </span>
                                <span
                                    class="like-count">{{ is_iterable($post->likes) ? $post->likes->count() : 0 }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Users posts --}}
    <div class="seperator">
        <h2>My posts</h2>
    </div>
    <div class="post-container">
        @if (count($myPosts) == 0)
            <div class="post-user-empty">
                You haven't posted anything yet!
            </div>
        @else
            @foreach ($myPosts as $post)
                <div class="post">
                    <div class="post-content">
                        <div class="user-profile-pic">
                            <img src="https://m.media-amazon.com/images/I/61e-cD4efFL._AC_SX522_.jpg" alt="">
                        </div>
                        <div class="post-content-inner">
                            <div class="post-content-inner">
                                <div class="post-content-inner-header">
                                    <h4>{{ $post->user->name }}</h4>
                                    <p>&nbsp;&nbsp;{{ $post->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            {{ $post['body'] }}
                            <div class="button-group">
                                <div class="button">
                                    <a href="/edit-post/{{ $post->id }}">
                                        <img class="post-icon" src="{{ asset('assets/edit_icon.svg') }}"
                                            alt="edit icon">
                                    </a>
                                </div>
                                <form action="/delete-post/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <img class="post-icon" src="{{ asset('assets/delete_icon.svg') }}"
                                            alt="delete icon">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.like-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const postId = btn.getAttribute('data-post-id');
                const liked = btn.getAttribute('data-liked') === '1';
                const url = liked ? `/posts/${postId}/unlike` : `/posts/${postId}/like`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        btn.setAttribute('data-liked', data.liked ? '1' : '0');
                        btn.querySelector('.like-icon').innerHTML = data.liked ?
                            `<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"#ff4757\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ff4757\" class=\"icon-svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z\"/></svg>` :
                            `<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ff4757\" class=\"icon-svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z\"/></svg>`;
                        btn.querySelector('.like-count').textContent = data.likes_count;
                        btn.classList.toggle('liked', data.liked);
                    });
            });
        });
    });
</script>
