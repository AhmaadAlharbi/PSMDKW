<!DOCTYPE html>
<html>

<head>
    <title>Access Denied</title>
    <style>
        body {
            background-color: #ffff;
            color: black;
        }

        h1 {
            color: red;
        }

        h6 {
            color: red;
            text-decoration: underline;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">

</head>

<body>
    <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>Access Denied</code></h1>
        <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
        <h3 class="w3-center w3-animate-right">You dont have permission to view this site.</h3>
        <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
        <h6 class="w3-center w3-animate-zoom">error code:403 forbidden</h6>
        <a class="btn btn-outline-danger" href="{{ route('blogs.blogs') }}">Back to Home</a>
    </div>
</body>

</html>