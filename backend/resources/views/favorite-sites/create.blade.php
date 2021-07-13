<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form enctype="multipart/form-data" action="{{ url('favorite-sites') }}" method="POST">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title">
        </div>
        <div>
            <label for="url">URL</label>
            <input type="text" name="url">
        </div>
        <div>
            <button type="submit">保存</button>
        </div>
    </form>
</body>

</html>
