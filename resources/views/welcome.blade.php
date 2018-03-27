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
        <img class="rbarresize" src="https://munihuite.gob.gt/wp-content/uploads/2016/05/BannerHuite.png" alt="...">
      </a>
    </div>
        
      
<!-- relevant content slides view: rslides.blade.php -->
    

<!-- relevant content slides end -->

  <div class="container">
    <div class="panel panel-body backgbody">
      <h2 class="cinzelfont whitefont">Ultimas Publicaciones</h2>
      <div class="col-md-9">
          @foreach($posts as $post)
            <div class="panel panel-default shadowedbox">
                <div class="panel-body">
                  <div class="contaniner">
                  <div class="col-md-6">
                      @if($post->imageurl)
                        <div class="">
                          <div class="">
                            <img width="400px" class="pull-left img-responsive" src="{{$post->imageurl}}" alt="">
                            
                          </div>
                          
                        </div>
                      @endif
                      
                    </div>
                    <div class="col-md-6">
                    <div class="panel-heading">
                      <a style="font-size: 25px; color:saddlebrown;" class="courgettefont" href="{{$post->category->slug}}/{{$post->slug}}">{{$post->name}}</a>
                    </div>
                    <div class="col-md-12">
                    <i class="fas fa-user" style="color: #888888;"></i> {{$post->user->username}}
                    <i class="fas fa-calendar" style="color: #888888;"></i> {{date('d-m-y', strtotime($post->created_at))}}
                    <i class="fas fa-folder" style="color: #888888;"></i> {{$post->category->name}}
                    </div>
                    <div class="panel-heading col-md-12">
                    {!! str_limit($post->excerpt)!!}
                    </div>
                    <div class="panel-heading col-md-12">
                    <a class="btn btn-primary pull-left" href="{{$post->category->slug}}/{{$post->slug}}">Leer Mas</a>
                    </div>
                    </div>
                    
                  </div>
  
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
              <img class="rbarresize" src="https://i0.wp.com/munihuite.gob.gt/wp-content/uploads/2018/01/Administracion2016-2020.png?ssl=1" alt="...">
            </a>
        </div>
      </div>
<!-- right Bar 2-->
      <div>
        <div class="row">
            <a href="#" class="pull-right">
              <img class="rbarresize" src="https://i1.wp.com/muniteculutan.gob.gt/wp-content/uploads/2016/04/Flor-de-la-Feria-1.jpg?w=852&ssl=1" alt="...">
            </a>
        </div>
      </div>
      <!-- End right Bar -->
      </div>
    </div>
  </body>
</html>
@endsection
