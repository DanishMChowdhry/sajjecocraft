<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> productName: {{ $productName }}</h1>
     <img src="{{ url('public/'.$main_image) }}" width="80%"  alt=""> 
    <p>{!! $description !!}</p>
    <br>
    <p>{{ $discountedPrice }} / {{ $price }}</p>
</body>
</html>
