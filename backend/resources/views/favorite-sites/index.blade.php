<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach($favoriteSites as $favoriteSite)
        <p>ID{{ $favoriteSite->id }}</p>
        <p>タイトル：{{ $favoriteSite->title }}</p>
        <p>URL{{ $favoriteSite->url }}</p>
        <br>
    @endforeach
</body>

</html>
