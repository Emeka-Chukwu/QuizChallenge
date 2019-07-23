@extends('inc.master')
@section('title')
    Challenges|Topic
@endsection

@section('contents')
    <div class="jumbotron">
             
        
            @foreach ($challenges as $challenge)
                {{-- <h1>check here {{$challenge->questiosns}}</h1> --}}
                <h3>
                    {{$challenge->challenge}}
                </h3>
                @if ($challenge->questions)
                <?php $counter = 0; ?>
                    @foreach ($challenge->questions as $question)
                    <?php $counter++?>
                    @if ($counter <= 4)
                        <div class="text-black"> 
                           <a href="/challenges/1/quiz#/">
                                {{$question->question}}
                            </a>
                        </div>
                    @endif
                    @endforeach
                @endif
            @endforeach
        
    </div>
    {{-- <example-component></example-component> --}}
    <td><span class="glyphicon glyphicon-envelope"> ee</span></td>


    
@endsection