@extends('layouts.admin.app')
	@section('content')
		<h3>Articulos</h3>

		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
			<button data-toggle="modal" data-target="#add_new_article_modal" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro</button>
			
				<table class="table table-stripped table-bordered table-responsive">
					<thead>
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Categoria</th>
							<th class="text-center">Usuario</th>
							<th class="text-center">Acciones</th>
						</tr>	
					</thead> 
					<tbody id="tbl-articles">
						
					</tbody>
					
				</table>
				<div class="text-right"></div>
					
				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
	
	
<div class="modal fade" id="add_new_article_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" accept-charset="UTF-8" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>

			</div>
			<div class="modal-body">
				 <form  action="" method="POST" id="frm-insert" enctype="multipart/form-data">
				 <!-- {{ URL::to('articles')}} -->
	                	<div class="form-group">
	                    	<label for="name">Titulo</label>
	                    	<input name="name" type="text" id="name" placeholder="Titulo" class="form-control"/>
	               		</div>
	 
	                	<div class="form-group">
	                    	<label for="slug">Slug</label>
	                    	<input name="slug" type="text" id="slug"  placeholder="Slug" class="form-control"/>
	                	</div>

						@if($categories != null)
							<div class="form-group">
								<label for="categoria">Categoria</label>
								<select name="category_id" id="category_id" class="selectpicker form-control">
									
									@foreach($categories as $category)
										<option value="{{$category->id}}">
											<td>{{$category->name}}</td>
										</option>
									@endforeach
								</select>
							</div>
						
						@else
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<select name="category_id" id="categoria" class="selectpicker form-control">
  									<option value="0">
								  		<td>no hay categorias</td>
									</option>
								
							</select>
						</div>

						@endif
						
						<input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id}}" />

						<div class="form-group">
    						<label for="imageurl">Cargar Imagen</label>
    						<input name="imageurl" type="file" class="form-control" id="imageurl">
    						
  						</div>
						<div class="form-group">
							<strong>Details:</strong>
							<textarea id="summernote" class="form-control" name="body"></textarea>
						</div>

						<div class="modal-footer">
	                		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-primary" value="Guardar" /> 
						</div>
				</form>
            </div>
        </div>
    </div>
</div>
	<!-- // Modal nuevo registro -->

	<!-- Modal - Actualizar registro -->
<div class="modal fade" id="update_article_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>

			<div class="modal-body">
				<form  action="" method="POST" id="frm-update">
				   <div class="form-group">
					   <label for="update_titulo">Titulo</label>
					   <input name="name" type="text" id="update_titulo" placeholder="Titulo" class="form-control"/>
					  </div>

				   <div class="form-group">
					   <label for="update_slug">Slug</label>
					   <input name="slug" type="text" id="update_slug"  placeholder="Slug" class="form-control"/>
				   </div>

				   @if($categories != null)
					  	<div class="form-group">
					  		<label for="update_categoria">Categoria</label>
					   		<select name="category_id" id="update_categoria" class="selectpicker form-control">
						   		@foreach($categories as $category)
								 	<option value="{{$category->id}}">
									 	<td>{{$category->name}}</td>
							   		</option>
						   		@endforeach
					   		</select>
				   		</div>
				   
				   		@else
						<div class="form-group">
							<label for="update_categoria">Categoria</label>
								<select name="category_id" id="update_categoria" class="selectpicker form-control">
									<option value="0">
										<td>no hay categorias</td>
									</option>
								</select>
						</div>

				   	@endif
					   <input id="update_user_id" name="updateuser_id" type="hidden" value="{{ Auth::user()->id}}" />
			   
				   	<div class="form-group">
					   <strong>Details:</strong>
					   <textarea id="updatesummernote" class="form-control" name="body"></textarea>
				   	</div>
	 
				   	<input name="id" type="hidden" id="update_id"  placeholder="" class=""/>

				   <div class="modal-footer">
					   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					   <input type="submit" class="btn btn-success" value="Actualizar" /> 
				   </div>
			   	</form>
			</div>
		</div>
	</div>
</div> 
	<!-- // Modal actualizar registro -->
@endsection

@section('script')
	<script type="text/javascript">

	
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

        $(document).ready(function(){
				getArticles();
			});

//-----------Mostrar Articulos---------------

			function getArticles(){
				$("#tbl-articles").empty();
				$.get('get-articles', function(data){
					$.each(data, function(i, value){
						var fila = $('<tr />');
						fila.append($('<td />', {
							text : value.id
						})).append($('<td />', {
							text : value.name
						})).append($('<td />', {
							text : value.category.name
						})).append($('<td />', {
							text : value.user.username
						})).append($('<td />', {
							html : '<a class="btn btn-sm btn-warning" href="" id="edit" data-id=' + value.id + ' >' +
									'<i class="fas fa-edit"></i> Editar</a>' +
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' onclick="">' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-articles").append(fila);
					});
				});
			}


//------------------Insertar articulos ---------------

$('#frm-insert').on('submit', function(e){

	e.preventDefault();
	  var datos = $(this).serializeArray(); //datos serializados
      var file = new FormData($('#frm-insert')[0]);

		//agregaremos los datos serializados al objecto imagen
		$.each(datos,function(key,input){
			file.append(input.name,input.value);
		});
		
  

    $.ajax({
        url: "{{url('articles')}}", // point to server-side PHP script
        data: file,
        type: 'POST',
		async: 	true,
        contentType: false, //'application/json', // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
		dataType: 'json',
        processData: false,
        success: function(data) {
			console.log(data);
			console.log(file);
			
			{
				$('#add_new_article_modal').modal('hide');
				getArticles()
				$.toast({
							heading: 'Information',
							text: 'Post creado exitosamente!',
							icon: 'info',
							position: 'top-right',
							loader: true,        // Change it to false to disable loader
							loaderBg: '#9EC600'  // To change the background
						});
			}
        },
		error: function(xr, exception){
			console.log(xr.responseText);
		}
    });
});



	// var _name = $('#name').val();
		// var _slug = $('#slug').val();
		// var _category_id = $('#category_id').val();
		// var _body = $('#summernote').val();
		// var _user_id = $('#user_id').val();
		// var _imageurl = $('#imageurl').prop('files')[0];


		// var form_data = new FormData();
		// form_data.append('name', _name);
		// form_data.append('category_id', _category_id);
		// form_data.append('slug', _slug);
		// form_data.append('user_id', _user_id);
		// form_data.append('body', _body);
		// form_data.append('image', '');
		// form_data.append('imageurl', _imageurl);

		// console.log(form_data.get('imageurl'))

			// $.ajaxSetup({
			//     headers: {
			//         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			//     }
			// });



	

			//-------------Editar Articulo-------------

			$('body').delegate('#tbl-articles #edit', 'click', function(e){
				e.preventDefault();
				var id = $(this).data('id');
				//console.log(id);
				$.get('articles/' + id + '/edit', {id:id}, function(data){
					$('#frm-update').find('#update_titulo').val(data.name)
					$('#frm-update').find('#update_slug').val(data.slug)
					$('#frm-update').find('#update_categoria').val(data.category_id)
					$('#frm-update').find('#updatesummernote').val(data.body)
					$('#frm-update').find('#update_user_id').val(data.user_id	)
					$('#frm-update').find('#update_id').val(data.id)
					$('#update_article_modal').modal('show');
				});
			});

			//-------------Actualizar Articulo-------------

				$('#frm-update').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var id 		= $('#update_id').val();
				$.ajax({
					type 	: 'put',
					url 	: 'articles/' + id,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{ 
						$('#update_article_modal').modal('hide');
						getArticles()
					}
					});
				});

				
			//-------------Eliminar Articulo-------------

				/*se creo esta funcion para que al dar click al boton elminiar muestre un alert con
				  mensajes para que el usuario de click a la opcion aceptar o cancelar */
			
			
						$('body').delegate('#tbl-articles #del', 'click', function(e){
							e.preventDefault();			
							swal({
								title: "Eliminar",
								text: "¿Realmente desea eliminar el articulo?",
								icon: "warning",
								buttons: true,
								dangerMode: true,
							})
								.then((willDelete) =>{
								if (willDelete) {
								var id = $(this).data('id');	
									$.post('{{route("articles.destroy", ' + id + ')}}', {id:id}, function(data){
										$(+id).remove();
									});
									
									swal("Poof! El articulo se eliminó correctamente!", {
										icon: "success",
										
									});
									getArticles() 

							} 
							else{
								swal("¡Operación cancelada por el usuario!");
							}
						});
			});

	</script>
@endsection