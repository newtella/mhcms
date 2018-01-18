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

    </head>
    <body>
<div class="container">

<div class="jumbotron">
  
  
</div>

</div>
        <div class="container">
        <div class="row">
        <div class="col-md-4"> 
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="http://petlosshousecalls.com/wp-content/uploads/2014/01/pet-loss-house-calls-brown-black-small-dog-large.jpg" alt="...">
            <div class="carousel-caption">
              Perro
            </div>
          </div>
          <div class="item">
            <img src="https://www.wellnesspetfood.com/sites/default/files/styles/blog_feature/public/media/images/happy-cat-blog-cover.jpg?itok=kJhdXlkP" alt="...">
            <div class="carousel-caption">
              Gato
            </div>
          </div>
          ...
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>




      <div class="col-md-4"> 
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="http://petlosshousecalls.com/wp-content/uploads/2014/01/pet-loss-house-calls-brown-black-small-dog-large.jpg" alt="...">
            <div class="carousel-caption">
              Perro
            </div>
          </div>
          <div class="item">
            <img src="https://www.wellnesspetfood.com/sites/default/files/styles/blog_feature/public/media/images/happy-cat-blog-cover.jpg?itok=kJhdXlkP" alt="...">
            <div class="carousel-caption">
              Gato
            </div>
          </div>
          ...
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>


      <div class="col-md-4"> 
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="http://petlosshousecalls.com/wp-content/uploads/2014/01/pet-loss-house-calls-brown-black-small-dog-large.jpg" alt="...">
            <div class="carousel-caption">
              Perro
            </div>
          </div>
          <div class="item">
            <img src="https://www.wellnesspetfood.com/sites/default/files/styles/blog_feature/public/media/images/happy-cat-blog-cover.jpg?itok=kJhdXlkP" alt="...">
            <div class="carousel-caption">
              Gato
            </div>
          </div>
          ...
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>



    </div>  
</div>

<div class="container">
  <div class="col-md-8">
    <h2>Lista de Articulos</h2>
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
  
</div>


    </body>
</html>
@endsection
