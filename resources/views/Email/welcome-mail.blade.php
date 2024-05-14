<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xxxxxx" crossorigin="anonymous"></script>

    </script>
    <title>Reset password</title>
</head>

<body>
    <h4>You have been Registered. Click below to rest your login password </h4>
    <a href="{{route('password.reset',$token)}}">
        <button class="btn"
        style="background-color: #007bff; color: #ffffff; padding: 10px 20px; border: none; border-radius: 5px;" >
        Reset Password</button></a>
</body>

</html>
