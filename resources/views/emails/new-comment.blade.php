<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <p>Good afternoon!</p><br>
    <p>On meeting
        <a href="http://127.0.0.1:8000/meetings/{{$meeting->id}}">{{$meeting->title}}</a>
        user {{$user->first_name}} {{$user->last_name}} posted comment on your lecture
        <a href="http://127.0.0.1:8000/lectures/{{$lecture->id}}">{{$lecture->theme}}</a>.
    </p>
</body>
</html>
