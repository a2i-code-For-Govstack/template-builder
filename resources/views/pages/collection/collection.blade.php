@extends('layouts.app')

@section('content')
    <div id="collection-search" class="container">
        <form action="{{ route('search') }}" method="GET">
            <input id="collection-searchbar"type="text" value="" name="query" placeholder="  Search..." required>
            <button id="collection-search-button"type="submit">Search</button>
        </form>
    </div>
    <div id="collection-hr"></div>
        @if(isset($results))
                @php
                $count = $results->count();
                $rows = ceil($count / 24);
                @endphp

                @for ($j = 0; $j < $rows; $j++)
                <div class="row">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="column">
                                @foreach($results as $result)
                                @if($result->sid < $j * 24 + $i * 6 + 6 && $result->sid > $j * 24 + $i * 6)
                                <a href="{{ route('form.any',['id' => $result->sid]) }}"><abbr title="{{$result->paper_size}}"><img src="{{ asset($result->background_image) }}" alt="Template Image"></abbr></a>
                                @endif
                                @endforeach
                        </div>
                        @endfor
                </div>
                @endfor

        @else
                @php
                        $count = $forms->count();
                        $rows = ceil($count / 24);
                @endphp

                @for ($j = 0; $j < $rows; $j++)
                        <div class="row">
                                @for ($i = 0; $i < 4; $i++)
                                <div class="column">
                                        @foreach($forms as $form)
                                        @if($form->sid < $j * 24 + $i * 6 + 6 && $form->sid > $j * 24 + $i * 6)
                                        <a href="{{ route('form.any',['id' => $form->sid]) }}"><abbr title="{{$form->paper_size}}"><img src="{{ asset($form->background_image) }}" alt="Template Image"></abbr></a>
                                        @endif
                                        @endforeach
                                </div>
                                @endfor
                        </div>
                @endfor

        @endif
<style>
        #collection-search{
                height:200px;
                display: flex;
                align-items:center;
                justify-content:center;
                background-color:#D7BDE2;
        }
        #collection-searchbar{
                background-color:transparent;
                width:400px;
                height:40px;
                border-radius:20px 0 0 20px;
                border:5px solid black;
        }
        #collection-search-button{
                height:40px;
                width:80px;
                border-radius:0 20px 20px 0;
                background-color:#BB8FCE;
                border:5px solid black;
        }
        #collection-hr{
                height:20px;
                background-color:#BB8FCE  ;
                margin-bottom:20px;
        }
        .row {
        display: flex;
        flex-wrap: wrap;
        padding: 0 4px;
        width:80%;
        margin:auto;
        background-color:#D7BDE2 ;
        }
        .column {
        flex: 25%;
        max-width: 25%;
        padding: 0 4px;
        }

        .column img {
        margin-top: 8px;
        vertical-align: middle;
        width: 100%;
        }
        .column img:hover{
                border: 10px solid #D7BDE2;
        }
        /* Responsive layout - makes a two column-layout instead of four columns */
        @media screen and (max-width: 800px) {
        .column {
        flex: 50%;
        max-width: 50%;
        }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        #collection-searchbar{
        width:250px;
        }
        .column {
        flex: 100%;
        max-width: 100%;
        }
        }
</style>
<script>
        
</script>
@endsection