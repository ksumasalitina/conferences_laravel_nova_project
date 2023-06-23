<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <p>Good afternoon!</p><br>
    <p>Meeting
        <a href="http://127.0.0.1:8000/meetings/{{$meeting->id}}">{{$meeting->title}}</a>
        joined new announcer {{$user->first_name}} {{$user->last_name}}
        with a lecture <a href="http://127.0.0.1:8000/lectures/{{$lecture->id}}">{{$lecture->theme}}</a>.
    </p>
</body>
</html>
