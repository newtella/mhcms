@extends('layouts.web.app')
@section('content')

<div class="container">
    <div class="col-md-12 ">
        
        <div class="panel panel-default">
                <div class="panel-heading">
                <h2>{{$articulo->name}}</h2>
                </div>
                <div class=" panel panel-body ">
                <img class="rbarresize" src="{{$articulo->imageurl}}" alt="">
                </div>
                <div class="panel-body">
                {!!$articulo->body!!}
                </div>
        </div>
    </div>
</div>

<div class="container">
    <h3>Articulos Relacionados</h3>
        @foreach($similarpost as $similar)
            <div class="col-md-7"> 
                <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        
                        <div class="panel-heading">
                            <h3>{{str_limit($similar->name, 25)}}</h3>
                        <div class="panel-body">
                            <div class="col-md-3">
                            @if($similar->imageurl)
                                <img width="200px" class="media-object" src="{{$similar->imageurl}}" class="img-responsive" alt="">
                            @endif
                            <p>{!! str_limit($similar->excerpt, 40)!!}</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
    @endforeach
</div>
</div>

@endsection

       