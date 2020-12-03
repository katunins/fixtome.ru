<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - панель</title>
</head>
<body>
    <div class="container">
        @foreach ($dataArr as $key=>$item)
            <div class="block">
                {{ $item['title'] }}
                @foreach ($item['likes'] as $like)
                    {{-- {{ $like['tweet'] }} --}}
                @endforeach
            </div>            
        @endforeach
    </div>
    
</body>
</html>