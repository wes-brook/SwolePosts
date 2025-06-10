<!-- Floating vertical nav buttons -->
<div class="floating-nav">
    <a href="/" class="floating-nav-btn" title="Home">
        <!-- Heroicon: Home -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125h3.75a.375.375 0 00.375-.375V16.5a.75.75 0 01.75-.75h2.25a.75.75 0 01.75.75v4.125c0 .207.168.375.375.375h3.75c.621 0 1.125-.504 1.125-1.125V9.75" />
        </svg>
    </a>
    <a href="/search" class="floating-nav-btn" title="Search">
        <!-- Heroicon: Magnifying Glass -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
        </svg>
    </a>
    <a href="#create-post" class="floating-nav-btn plus-btn" title="New Post">
        <!-- Heroicon: Plus -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>
    <a href="/likes" class="floating-nav-btn" title="Likes" style="position:relative;">
        <!-- Heroicon: Heart -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>
    </a>
    <a href="/profile" class="floating-nav-btn" title="Profile">
        <!-- Heroicon: User -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
    </a>
    <form action="/logout" method="POST" style="margin:0;">
        @csrf
        <button type="submit" class="floating-nav-btn" title="Logout"
            style="border:none;background:none;padding:0;cursor:pointer;">
            <!-- Heroicon: Arrow Right On Rectangle (Logout) -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 12h-9m0 0l3-3m-3 3l3 3" />
            </svg>
        </button>
    </form>
</div>
<!-- End floating nav -->
<div class="container-centered">
    <navbar>
        <a class="navbar-title-link" href="/">
            <h1 class="navbar-title">SwolePosts</h1>
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
                            <button class="like-btn{{ $post->likedBy(auth()->user()) ? ' liked' : '' }}"
                                data-post-id="{{ $post->id }}" data-liked="{{ $post->likedBy(auth()->user()) ? '1' : '0' }}"
                                aria-label="Like">
                                <span class="like-icon">
                                    @if($post->likedBy(auth()->user()))
                                        <!-- Heroicon: Heart Solid -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ff4757" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#ff4757" class="icon-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    @else
                                        <!-- Heroicon: Heart Outline -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#ff4757" class="icon-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    @endif
                                </span>
                                <span class="like-count">{{ is_iterable($post->likes) ? $post->likes->count() : 0 }}</span>
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
                                    <img class="post-icon" src="{{ asset('assets/edit_icon.svg') }}" alt="edit icon">
                                </a>
                            </div>
                            <form action="/delete-post/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <img class="post-icon" src="{{ asset('assets/delete_icon.svg') }}" alt="delete icon">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.like-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const postId = btn.getAttribute('data-post-id');
                const liked = btn.getAttribute('data-liked') === '1';
                const url = liked ? `/posts/${postId}/unlike` : `/posts/${postId}/like`;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        btn.setAttribute('data-liked', data.liked ? '1' : '0');
                        btn.querySelector('.like-icon').innerHTML = data.liked
                            ? `<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"#ff4757\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ff4757\" class=\"icon-svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z\"/></svg>`
                            : `<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ff4757\" class=\"icon-svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z\"/></svg>`;
                        btn.querySelector('.like-count').textContent = data.likes_count;
                        btn.classList.toggle('liked', data.liked);
                    });
            });
        });
    });
</script>