<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('register')}}">
        @csrf
        <input type="text" name="Name" id="Name" required><br>
        <input type="email" name="Email" id="Email" required>@error('email')
            {{$message}}
        @enderror<br>
        <input type="password" name="Password" id="Password" required><br>
        <input type="password" name="ConfirmPassword" id="CnfPassword" required onkeydown="onconfpass()"><span id="confpass"></span><br>
        <input type="submit" >
    </form>
    <script>
        function onconfpass()
        {
            var realpass = document.getElementById('Password').value;
            var confpass = document.getElementById('CnfPassword').value;
            if(realpass === confpass)
            {
                document.getElementById('confpass').style.color = "green";
                document.getElementById('confpass').innerHTML = "password match";
            }
            else{
                document.getElementById('confpass').style.color = "red";
                document.getElementById('confpass').innerHTML = "password dosent match";
            }
        }
    </script>
</body>
</html>