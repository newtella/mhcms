@extends('layouts.web.app')
@section('content')

<div class="container">
    <div class="col-md-8">
        <h2>{{$articulo->name}}</h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$articulo->name}}
                </div>
                <div class="panel-body">
                {{$articulo->imageurl}}
                {!!$articulo->body!!}

                </div>
            </div>
  </div>




</div>

@endsection