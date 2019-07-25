@extends('inc.master')
@section('title')
   
        Quiz challenges for everyone
    
@endsection


@section('contents')

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="/storage/images/imagetwo.jpg" alt="Third slide">

          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/storage/images/imageone.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/storage/images/image1.jpg" alt="First slide">

          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    @if ($subjects->count() > 0)
   
        {{-- <style>
            .display{ 
                /* url('public/backgroundimg'); */
                background: url('public/backgroundimg/backgroundimage.jpg');
                background-repeat: no-repeat;
                min-width:100%;
                min-height: 60vh;
            }
        </style> --}}
       
        <div class="container">
            <div class="display text-capitalize text-center">

            </div>
            <br>
            
            
        <div class="row">
                @foreach ($subjects as $subject)
            <div class="col-xs-12 col-sm-12 col-md-6">
                <br>
                <div class="card">
                    <div class="card-body">
                        <img src="#" alt="No image yet" class="card-img-top">
                        <h3 class="card-title">{{$subject->subject}}</h3>
                        <h6 class="card-title">{{$subject->description}}</h6>
                        <?php
                            $counter = 0;
                        ?>
                        {{-- @if ($subject->topics) --}}
                        @foreach ($subject->topics as $topic)
                        <?php $counter++?>
                            @if ($counter <= 4)
                                <div class="text-black"> 
                                    <a href="challenges/{{$topic->id}}" class="text-info" >
                                        {{$topic->topic}}
                                    </a>
                                </div>
                                    
                            @endif
                        @endforeach
                        {{-- @endif  --}}
                        {{-- <div class="card-text">{{$subject->topics}} </div> --}}
                            <a href="/topics/{{$subject->id}}" class="btn btn-primary float-light">
                                            Read More
                        </a>
                                    
                    </div>
                </div>
            {{-- <h2>{{$subject->subject}}</h2> --}}

            
            {{--  --}}
            {{-- <h2>{{$subject->subject}}</h2> --}}
        
                
               
            </div>   
       

        @endforeach   
    </div> 
</div>    
    @endif
    {{-- <router-view></router-view> --}}
    


@endsection