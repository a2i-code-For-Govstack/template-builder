<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <style>

        @font-face {
        font-family: "Times New Roman", Times, serif;
        }
        * {
            font-family:"Times New Roman", Times, serif;
        }
        @font-face {
            font-family: "Times New Roman", Times, serif;
            src: url({{asset('fonts/times_new_roman.ttf')}}); /*URL to font*/
        }
    </style>
</head>

<body>
    <div>
        <?php echo $content ?>
    </div>
</body>

</html>
