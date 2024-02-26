<!DOCTYPE html>

<head>
    @vite('resources/js/app.js')

    <title>Cuss Counter</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div id="app">
        <div class="wrapper">
            <span id="count">{{ $count }}</span>
            <a id="button" href="/add">He said the thing!</a>
            <span id="divider"></span>
            <a id="undo" href="/min">undo?</a>
        </div>
    </div>
</body>
<html>
