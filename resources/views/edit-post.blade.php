<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo asset('css/main.css');?>" type="text/css">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{$post->title}}">
            <textarea name="body">{{$post->body}}</textarea>
            <button>Save Changes</button>
        </form>
    </div>
</body>
</html>