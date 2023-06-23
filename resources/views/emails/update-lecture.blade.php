<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p>Good afternoon!</p><br>
<p>On meeting
    <a href="http://127.0.0.1:8000/meetings/{{$meeting->id}}">{{$meeting->title}}</a>
    announcer {{$user->first_name}} {{$user->last_name}} with a lecture
    <a href="http://127.0.0.1:8000/lectures/{{$lecture->id}}">{{$lecture->theme}}</a>
    has changed lecture time.
</p>
<p>New lecture time: {{$time->start}} - {{$time->end}}</p>
</body>
</html>
