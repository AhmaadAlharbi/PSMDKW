<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead">Your report has been saved</p>
        <hr>

        <p class="lead">

        <div class="p-4 mb-2 bg-info text-white">
            <h2> لرؤية تقاريرك والتعديل عليها يرجى التسجيل في الموقع بالايميل الوزاري
            </h2>
        </div>
        <a class="btn btn-success btn-lg p-3" href="{{route('register')}}" role="button">Register</a>

        <a class="btn btn-outline-info btn p-3" href="{{route('blogs.blogs')}}" role="button">Home page</a>
        </p>
    </div>
</body>

</html>