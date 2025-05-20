<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('css/stylesheet.css');?>" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>SwolePosts</h1>
        <p>- If you're just getting started, you're in the right place -</p>
        @auth
            <!-- User logged in -->
            <p>congrats, you're logged in</p>
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
            <div style="border: 3px solid black; padding: 10px;">
                <h2>Create a new post</h2>
                <form action="/create-post" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="post title">
                    <textarea name="body" placeholder="body content"></textarea>
                    <button>Save Post</button>
                </form>
            </div>
            <div style="border: 3px solid black; padding: 10px;">
                <h2>My posts</h2>
                @foreach($posts as $post)
                <div style="background-color: gray; padding: 10px; margin: 10px">
                    <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                    {{$post['body']}}
                    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
                @endforeach
            </div>
        @else
            <!-- User not logged in -->
            <div class="auth-container">
                <div class="auth-form">
                    <h2>Login</h2>
                    <form action="/login" method="POST">
                        @csrf
                        <input type="text" name="loginname" placeholder="name">
                        <input type="password" name="loginpassword" placeholder="password">
                        <button>Log in</button>
                    </form>
                </div>
                <div class="auth-form">
                    <h2>Register</h2>
                    <form action="/register" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="name">
                        <input type="text" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">
                        <button>Register</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

</body>

</html>
