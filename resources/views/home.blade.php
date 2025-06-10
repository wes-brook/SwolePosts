<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="<?php echo asset('css/main.css'); ?>" type="text/css">
    <title>SwolePosts</title>
</head>

<body>
    <div class="container">
        @auth
            @include('components.userHome')
        @else
            @include('components.loginPage')
        @endauth
    </div>
    <script src="{{ asset('js/autogrow.js') }}"></script>
</body>

</html>