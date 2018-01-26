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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>

			</div>
			<div class="modal-body">
				 <form  action="{{ URL::to('articles')}}" method="POST" id="frm-insert">

	                	<div class="form-group">
	                    	<label for="titulo">Titulo</label>
	                    	<input name="name" type="text" id="titulo" placeholder="Titulo" class="form-control"/>
	               		</div>
	 
	                	<div class="form-group">
	                    	<label for="slug">Slug</label>
	                    	<input name="slug" type="text" id="slug"  placeholder="Slug" class="form-control"/>
	                	</div>

						@if($categories != null)
							<div class="form-group">
								<label for="categoria">Categoria</label>
								<select name="category_id" id="categoria" class="selectpicker form-control">
									
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
						
						<input name="user_id" type="hidden" value="{{ Auth::user()->id}}" />
					
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
					   <input id="update_user_id" name="user_id" type="hidden" value="{{ Auth::user()->id}}" />
			   
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

        $(document).ready(function(){
				getArticles();
			});

			function getArticles(){
				$.get('get-articles', function(data){
					console.log(data);
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
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' onclick="Confirm()">' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-articles").append(fila);
					});
				});
			}


		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#frm-insert').on('submit', function(e){
			e.preventDefault();
			var data 	= $(this).serialize();
			var url 	= $(this).attr('action');
			var post 	= $(this).attr('method');
			
				console.log(data.length)
			$.ajax({

				type 	 : post,
				url  	 : url,
				data 	 : data,
				dataType : 'json',
				success:function(data)
					{
						location.reload();
						$('#add_new_post_modal').modal('hide');
						
					}
			})

		});

			//Eliminar Articulo

			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});



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
						location.reload();
						$('#update_article_modal').modal('hide');
					}
					});
				});

				
			//-------------Eliminar Articulo-------------

				/*se creo esta funcion para que al dar click al boton elminiar muestre un alert con
				  mensajes para que el usuario de click a la opcion aceptar o cancelar */
			
			function Confirm() {				
				//Ingresamos un mensaje a mostrar
				var id = confirm("¿Desea eliminar el registro?");

					//Detectamos si el usuario acepto el mensaje
					if (id) {
						$('body').delegate('#tbl-articles #del', 'click', function(e){
							var id = $(this).data('id');
								$.post('{{ URL::to("articles/{id}") }}', {id:id}, function(data){
									$(+id).remove();
										alert("¡Se a eliminado exitosamente!");
								});
						});
					}
					//Detectamos si el usuario denegó el mensaje
					else {
						alert("¡No se realizo ningun cambio !");
					}
			}
	</script>
@endsection