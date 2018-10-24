<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cruds</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;,
        height: 100%;
            width: 100%;
            background-color: #d1d1d1
        }
        #mute {
            position: absolute;
        }
        #mute.on {
            opacity: 0.7;
            z-index: 1000;
            background: white;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>

{{--<div id="mute"></div>--}}
{{--<div id="app"></div>--}}
<div id="demo"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script>
    new Vue({
        el: "#demo",
        data: {
            message: "Hello Vue.js!"
        }
    });
</script>
<script src="public/js/app.js"></script>
</body>
</html>
