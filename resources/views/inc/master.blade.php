@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <br>
        <div class="col-xs-12 col-sm-12 col-md-8" style="margin-top:20px">
                @yield('contents')
        </div>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-4 hidden-xs-down hidden-sm-down hidden-md-down" style="margin-top:20px">
            <br>
            <div class="text-center text-capitalize card" style="height:45vh">
                <h3 class="bg-primary text-white" style="margin-bottom:20px"><br>

                        the sidebar of the website 
                        <br>
                </h3>
                {{-- <img src="/storage/images/image1.jpg" alt="quiz"> --}}
                <div class="card-img">
                    <img src="/storage/images/imagethree.jpg" alt="quiz">
                </div>
                        @yield('sidebar')
                
            </div>
        </div>
    </div>
</div>    
@endsection



<footer>
    {{-- the footer of all pages of this website will be written here and display on all pages  --}}
    {{-- of the website with the help of extends feature --}}
</footer>