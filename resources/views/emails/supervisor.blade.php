<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration email</title>
</head>
<body>
    <h2>مرحبًا {{$sName}}</h2>
    <h4>برجاء ملأ هذه الإستمارة:</h4>
    <p><a href={{$formLink}}>{{$formLink}}</a></p><br>
    <h4>هذا هو الرقم الكودي الخاص بك:</h4>
    <p>{{$sId}}</p><br>
    <p>شكرًا لك :)</p>

</body>
</html>