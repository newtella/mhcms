@extends('layouts.web.app')
@section('content')

<div class="container">
    <div class="col-md-12 pull-left">
        <h2>{{$articulo->name}}</h2>
        <div class="panel panel-default">
                <div class="panel-heading">
                    {{$articulo->name}}
                </div>
                <div class="panel-body">
                <img src="{{$articulo->imageurl}}" alt="">
                {!!$articulo->body!!}
                </div>
            </div>
<<<<<<< HEAD
  </div>

=======
    </div>

<div class="container">
    <h3>Articulos Relacionados</h3>
        @foreach($similarpost as $similar)
            <div class="col-md-4"> 
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>{{str_limit($similar->name, 25)}}</h3>
                        <div class="panel-body">
                            @if($similar->imageurl)
                                <img width="50px" class="media-object" src="{{$similar->imageurl}}" class="img-responsive" alt="">
                            @endif
                            <p>{!! str_limit($similar->excerpt, 40)!!}</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    @endforeach
>>>>>>> 959c2089d9fa4c0376633572d99ae3cee3fa35d0
</div>
</div>

@endsection

       