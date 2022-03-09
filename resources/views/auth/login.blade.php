<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action={{route('login')}}>
        @csrf
        <input type="email" name="Email" id="email" required>@error('error')
            {{$message}}
        @enderror<br>
        <input type="password" name="Password" id="password" required>@error('error')
        {{$message}}
    @enderror<br>
        <input type="submit">
    </form>
</body>
</html>