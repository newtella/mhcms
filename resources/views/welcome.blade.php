@extends('layouts.web.app')
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Municipalidad de Huite</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">



    </head>
  <body>
   
    <div class="container">
      <a href="#">
        <img class="rbarresize" src="http://www.oneyogaglobal.com/wp-content/uploads/2015/11/Guatemala-banner.jpg" alt="...">
      </a>
    </div>
        
      
<!-- relevant content slides view: rslides.blade.php -->
    @include('rslides') 
<!-- relevant content slides end -->

  <div class="container">
    <div class="panel panel-body backgbody">
      <h2 class="cinzelfont whitefont">Ultimas Publicaciones</h2>
      <div class="col-md-9 ">
          @foreach($posts as $post)
            <div class="panel panel-default">
              <div class="panel-heading">
                <a style="font-size: 25px; color:saddlebrown;" class="courgettefont" href="{{$post->category->slug}}/{{$post->slug}}">{{$post->name}}</a>
              </div> 
                <div class="panel-body">
                  <div class="contaniner">
                    <div class="col-md-6">
                    {{$post->excerpt}}
                    </div>
                    <div class="col-md-6">
                      @if($post->imageurl)
                        <div>
                          <div>
                            <img width="300px" class="pull-right" src="{{$post->imageurl}}" class="img-responsive" alt="">
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                <a class=" btn btn-primary pull-right" href="{{$post->category->slug}}/{{$post->slug}}">Leer Mas</a>
                </div>
                  
                  
            </div>
          @endforeach
            {{$posts->render()}}
      </div>
      <!-- right Bar 1-->
    <div class="col-md-3">
      <div>
        <div class="row">
            <a href="#" class="pull-right">
              <img class="rbarresize" src="https://i.pinimg.com/originals/eb/e6/13/ebe613f67b90a6eeee9afe77d2e224d0.jpg" alt="...">
            </a>
        </div>
      </div>
<!-- right Bar 2-->
      <div>
        <div class="row">
            <a href="#" class="pull-right">
              <img class="rbarresize" src="http://mapasdeguatemala.com/mdg/wp-content/uploads/2015/10/portada-Tikal-600.jpg" alt="...">
            </a>
        </div>
      </div>
      <!-- End right Bar -->
      </div>
    </div>
  </body>
</html>
@endsection
