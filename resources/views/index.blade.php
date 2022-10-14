<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summernote with Bootstrap 4</title>

</head>
<body>
    <a class="" href="{{ route('summernote.create')}}">
        criar novo post
    </a>
    <div>
        @foreach($Posts as $Post)
            <h3>{{$Post->title}}</h3>
            <div>{!!$Post->description!!}</div>
        @endforeach
    </div>
</body>
</html>
