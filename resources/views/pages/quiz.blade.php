@extends('inc.master')
@section('contents')
    @if ($question->count() > 0)
        @foreach ($question as $question)
            <h4>{{$question->question}}</h4>
            <h4>{{$question->challenges->challenge}}</h4>
            <?php $userId = 1; $userName = 'Emeka Pascal';?>
            {{$userId}}
            <router-view :challenge-name ="'{{$question->challenges->challenge}}'"
                :user-id="'{{$userId}}'"
                :user-name="'{{$userName}}'"></router-view>
    {{-- <router-view></router-view> --}}

        @endforeach
    @endif
@endsection