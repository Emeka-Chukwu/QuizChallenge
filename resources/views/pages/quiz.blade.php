@extends('inc.master')
@section('contents')
    @if ($question->count() > 0)
    <div class="container">
        <div class="card">
            <div class="card-body">
        @foreach ($question as $question)
            {{-- <h4>{{$question->question}}</h4>
            <h4>{{$question->challenges->challenge}}</h4> --}}
            <?php $userId = 1; $userName = 'Emeka Pascal';?>
            {{-- {{$userId}} --}}
            <router-view :challenge-name ="'{{$question->challenges->challenge}}'"
                :user-id="'{{$userId}}'"
                :user-name="'{{$userName}}'"></router-view>
    {{-- <router-view></router-view> --}}

        @endforeach
            </div>
        </div>
    </div>
    @else
                <h2 class="text-center text-capitalize">no questions yet</h2>
                <p class="text-center text-danger" >
                    There are no questions for this challenge yet.
                </p>
    @endif
@endsection