@extends('inc.master')

@section('contents')
<div class="containe">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">Dashboard</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- You are logged in! --}}
                    <?php
                    if(Auth::check()){
                    
                        $show = Auth::user()->name;
                        $showd = Auth::user()->id;
                        // $showd = 0;


                        // echo $show .' the id '.$showd;
                        // $showd;
                    }
                    ?>
                    <navbar-component 
                    :user-id="'{{Auth::user()->id}}'"
                    {{-- :challenge-name ="'{{$question->challenges->challenge}}'" --}}
                    {{-- :user-id="'{{Auth::user()->}}'" --}}
                    :user-name="'{{Auth::user()->name}}'"
                    ></navbar-component>
                    {{-- the routing of vuejs --}}
                    {{-- <router-view :user-id="'{{Auth::user()->id}}'"></router-view> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
