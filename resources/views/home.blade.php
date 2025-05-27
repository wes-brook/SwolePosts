<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('css/main.css'); ?>" type="text/css">
    <title>SwolePosts</title>
</head>

<body>
    <div class="container">
        @auth
            <!-- User logged in - centered content, no video -->
            <div class="container-centered">
                <navbar>
                    <h1 class="navbar-title">SwolePosts</h1>
                    <div class="navbar-info">
                        <p>{{ auth()->user()->name }} logged in</p>
                        <form action="/logout" method="POST">
                            @csrf
                            <button>Logout</button>
                        </form>
                    </div>
                </navbar>
                <div class="create-post-container">
                    <h2>Create a new post</h2>
                    <form action="/create-post" method="POST">
                        @csrf
                        <input type="text" name="title" placeholder="What'd you train today?">
                        <textarea id="autogrow" name="body" placeholder="Start typing..."></textarea>
                        <button>Save Post</button>
                    </form>
                </div>
                <h2>Everyones Posts</h2>
                <div class="post-container">
                    @foreach ($otherPosts as $post)
                        <div class="post">
                            <h3>{{ $post['title'] }} by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                            </h3>
                            {{ $post['body'] }}
                        </div>
                    @endforeach
                </div>
                <h2>My posts</h2>
                <div class="post-container">
                    @foreach ($myPosts as $post)
                        <div class="post">
                            <h3>{{ $post['title'] }} by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                            </h3>
                            {{ $post['body'] }}
                            <div class="button-group">
                                <div class="button">
                                    <a href="/edit-post/{{ $post->id }}">Edit</a>
                                </div>
                                <form action="/delete-post/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- User not logged in - split layout with video -->
            <div class="container-left">
                <div class="video-container">
                    <video autoplay muted loop>
                        <source src="<?php echo asset('assets/videoplayback.mp4'); ?>" type="video/mp4">
                        If you're seeing this, your browser could not handle Ronnie Yeah Buddy Coleman.
                    </video>
                </div>
            </div>
            <div class="container-right">
                <div class="spline-background">
                    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.96/build/spline-viewer.js"></script>
                    <spline-viewer url="https://prod.spline.design/H5LLDspru1NGKy9d/scene.splinecode"></spline-viewer>
                </div>

                <div class="content-overlay">
                    <h1>SwolePosts</h1>
                    <p>Train your brain. Document your mind.</p>
                    <div class="auth-container">
                        <div class="auth-forms">
                            <div class="auth-form">
                                <h2>Login</h2>
                                <form action="/login" method="POST">
                                    @csrf
                                    <input type="text" name="loginname" placeholder="Username or email">
                                    <input type="password" name="loginpassword" placeholder="Password">
                                    <div class="remember-me">
                                        <p>Remember login details?</p>
                                        <input type="checkbox" name="remember" id="remember">
                                    </div>
                                    <button>Log in</button>
                                </form>
                            </div>
                            <div class="auth-form">
                                <h2>Register</h2>
                                <form action="/register" method="POST">
                                    @csrf
                                    <input type="text" name="name" placeholder="Username">
                                    <input type="text" name="email" placeholder="Email">
                                    <input type="password" name="password" placeholder="Password">
                                    <button>Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <script>
        const textarea = document.getElementById('autogrow');

        const autoGrow = () => {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        // Trigger on page load in case of old input
        autoGrow();

        // Adjust height on user input
        textarea.addEventListener('input', autoGrow);
    </script>
</body>

</html>
