@extends('inc.master')
@section('title')
    Challenges|Topic
@endsection

@section('contents')
    <div class="container">
             
            @if (count($challenges) > 0)
                
            @foreach ($challenges as $challenge)
                <div class="card" style="margin-bottom:12px">
                    <div class="card-body">
                <h3>
                    {{$challenge->challenge}}
                </h3>
                <p><a href="/challenges/{{$challenge->id}}/quiz" class="btn btn-primary float-right"><span>Take a bow</span></a></p>
                @if ($challenge->questions)
                <?php $counter = 0; ?>
                    @foreach ($challenge->questions as $question)
                    <?php $counter++?>
                    @if ($counter <= 4)
                        
                    @endif
                    @endforeach
                @endif
                </div>
            </div>

            @endforeach
            
            @endif
    </div>
    {{-- <example-component></example-component> --}}
    


    
@endsection