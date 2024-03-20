<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <style>
        * {
            font-family: SolaimanLipi;
            /* font-family: Nikosh; */
        }
    </style>


    <script>
        page.paperSize = {format: 'A4', orientation: 'landscape', margin: '1cm'};
    </script>
</head>

<body>
    <div>
        <?php echo $content ?>
    </div>
</body>

</html>
