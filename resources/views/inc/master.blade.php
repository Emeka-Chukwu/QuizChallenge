@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-sm-7">
                @yield('contents')
        </div>
        <div class="col-xs-12 col-md-4 col-sm-5">
            <div class="text-center text-danger">
                <h3>
                        this is the sidebar page of the the template
                        @yield('sidebar')
                </h3>
            </div>
        </div>
    </div>
</div>    
@endsection



<footer>
    {{-- the footer of all pages of this website will be written here and display on all pages  --}}
    {{-- of the website with the help of extends feature --}}
</footer>