@extends('layouts.web.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <h2>{{$articulo->name}}</h2>
        <div class="panel panel-default">
                <div class="panel-heading">
                <h2>{{$articulo->name}}</h2>
                </div>
                <div class=" panel panel-body ">
                <img class="media-object"  width="200px" src="{{asset($articulo->imageurl)}}"  class="img-responsive" alt="">
                </div>
                <div class="panel-body">
                    {!!$articulo->body!!}
                    <input type="hidden" id="post_id" value="{{$articulo->id}}">
                </div>
        </div>
   
        <h3>Articulos Relacionados</h3>
        @foreach($similarpost as $similar)
                <div class="col-md-3"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>{{str_limit($similar->name, 25)}}</h3>
                            <div class="panel-body">
                                @if($similar->imageurl)
                                    <img class="rbarresize" width="200px" class="media-object" src="{{asset($similar->imageurl)}}" class="img-responsive"   alt="">
                                @endif
                                <p>{!! str_limit($similar->excerpt, 40)!!}</p>
                                <p><a href="#" class="btn btn-primary" role="button">Button</a>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> 
                <i class="fas fa-user" style="color: #04B486;"></i> Comentanos:</h3>
                    <div class="panel-body">
                        <form id="frm-comment" action="/comments" method="post" style="display: block;">   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" placeholder="Escribe tu nombre" class="form-control">
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Correo electronico" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="body" id="body" rows="5" placeholder="Escribe tu comentario..." class="form-control"></textarea>   
                                    <input type="hidden" name="post_id" id="post_id" value="{{$articulo->id}}">
                                        <br>
                                        <input align="right" style="width:100px; height:40px" type="submit" class="btn btn-success form-control" value="Publicar" align="right" width="48" height="48" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
         
            <div class="col-md-12">
                <div class="comments">
                    <ul id="listComments" class="list-group">
                            
                    </ul>
                </div>
            </div>
</div>          


@endsection

@section('script')
	<script type="text/javascript">
			
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        $(document).ready(function(){
            var postId = $("#post_id").val();
            listarComentarios(postId);
        });

        function listarComentarios( _id ){
            $("#listComments").empty();
            $.ajax({
                url: '../get-comments/',
                type: 'GET',
                data: { id: _id },
                success: function(response)
                {
                    $.each(response, function(i, value){
                        var elemento = $('<li class="list-group-item" />');
                        elemento.append($('<strong />', {
                            text : value.name
                        }));
                        elemento.append($('<strong />', {
                            text : value.body
                        }));
                        $("#listComments").append(elemento);
                    });
                }
            });

        }

        $('#frm-comment').on('submit', function(e){
            e.preventDefault();
            var data 	= $(this).serialize();
            var url 	= $(this).attr('action');
            var post 	= $(this).attr('method');
            var postId  = $("#post_id").val();
            console.log(data);
            $.ajax({
                type 	: post,
                url 	: url,
                data 	: data,
                dataType: 'json',
                success:function(data)
                { 
            console.log(data);                    
                    $("#name").val("");
                    $("#email").val("");
                    $("#body").val("");
                    listarComentarios(postId);
                }
            });
        });

	</script>
@endsection       