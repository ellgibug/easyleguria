<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новое сообщение</title>
</head>
<body>
<p><strong>Имя: </strong>{{ $data->name }}</p>
<p><strong>Емейл: </strong>{{ $data->email }}</p>
<p><strong>Тема: </strong>{{ $data->subject }}</p>
<p><strong>Сообщение: </strong>{{ $data->message }}</p>
</body>
</html>