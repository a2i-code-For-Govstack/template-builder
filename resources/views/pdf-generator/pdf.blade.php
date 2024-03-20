<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->


    <title>PDF Example</title>
    <style>
        /* .english {
            font-family: sans-serif, 'times_new_roman';
            font-size: 15px
        }

        .bangla {
            font-family: sans-serif, 'solaiman_lipi';
            font-size: 15px
        } */
        body {
            font-family:'georgia';
            margin-left: 3%;
            margin-right: 3%;
        }

        @page {
            padding-left: 3%;
            padding-right: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
        }



        .content {
            margin-left: 3%;
            margin-right: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
        }
    </style>
</head>

<body>


    <div class="content" >
        {!! $data['content'] !!}

    </div>

   

   


</body>

</html>

