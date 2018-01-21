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
    </head>
  <body>
   
    <div class="container">
      <a href="#">
        <img class="rbarresize" src="http://www.travelntime.in/images/guatemala-banner.jpg" alt="...">
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
                <a href="{{$post->category->slug}}/{{$post->slug}}">{{$post->name}}</a>
              </div> 
                <div class="panel-body">
                  @if($post->imageurl)
                    <div class="media">
                      <div class="media-left">
                        <img width="200px" class="media-object" src="{{$post->imageurl}}" class="img-responsive" alt="">
                      </div>
                    </div>
                  @endif
                    {{$post->excerpt}}
                        <a href="{{$post->category->slug}}/{{$post->slug}}">Leer Mas</a>
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
