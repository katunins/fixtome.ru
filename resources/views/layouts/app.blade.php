<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">

    <title>@yield('title')</title>
</head>

<body>
    @yield('content')
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        let logoElem = document.querySelector('.logo')
if (logoElem) logoElem.onclick = function(){
            document.location = '/'
        }
        
    })
</script>