<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qr Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <p class="mb-0">Simple</p>
                {!! $simple !!}
            </div>
            <div class="col">
                <p class="mb-0">Color Change</p>
                {!! $changeColor !!}
            </div>
            <div class="col">
                <p class="mb-0">Background Color Change </p>
                {!! $changeBgColor !!}
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <p class="mb-0">Style Square</p>
                {!! $styleSquare !!}
            </div>
            <div class="col">
                <p class="mb-0">Style Dot</p>
                {!! $styleDot !!}
            </div>
            <div class="col">
                <p class="mb-0">Style Round</p>
                {!! $styleRound !!}
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
