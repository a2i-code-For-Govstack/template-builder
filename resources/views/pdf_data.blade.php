<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>

    <style>
        @font-face {
            font-family: "kalpurush";
            src: url({{asset('assets/css/fonts/kalpurush.ttf')}}) format('true-type');
        }

        * {
            font-family: "kalpurush";
        }
    </style>
</head>

<body>
    {!! html_entity_decode($html, ENT_QUOTES, 'UTF-8') !!}
</body>

</html>