@extends('layouts.admin.app')
@section('content')
<h3>Categorias</h3>

	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
			<button data-toggle="modal" data-target="#add_new_category_modal" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro</button>
			
				<table class="table table-stripped table-bordered table-responsive">
					<thead>
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">URL Amigable</th>
							<th class="text-center">Descripcion</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead> 
					<tbody id="tbl-categories">
						
					</tbody>
					
				</table>
				<div class="text-right"></div>

				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
		
	<div class="modal fade" id="add_new_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
	                	<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>
	
	            </div>
	            <div class="modal-body">
	 				<form  action="{{ URL::to('categories')}}" method="POST" id="frm-insert">

	                	<div class="form-group">
	                    	<label for="name">Name</label>
	                    	<input name="name" type="text" id="name" placeholder="Name" class="form-control"/>
	                	</div>
	 
	                	<div class="form-group">
	                    	<label for="categoryslug">Slug</label>
	                   		<input name="slug" type="text" id="categoryslug"  placeholder="Slug" class="form-control"/>
	                	</div>
		
						<div class="form-group">
							<strong>Descripcion:</strong>
							<textarea id="description" class="form-control" name="body"></textarea>
						</div>

						<div class="modal-footer">
	                		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-success" value="Guardar" /> 
						</div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- // Modal nuevo registro -->

	<!-- Modal - Actualizar registro -->
 
	<div class="modal fade" id="update_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
					<div class="modal-body">
					<form  action="" method="POST" id="frm-update">
					<div class="form-group">
						<label for="update_name">Name</label>
						<input name="name" type="text" id="update_name" placeholder="Name" class="form-control"/>
					</div>

					<div class="form-group">
						<label for="update_categoryslug">Slug</label>
							<input name="slug" type="text" id="update_categoryslug"  placeholder="Slug" class="form-control"/>
					</div>
	
					<div class="form-group">
						<strong>Descripcion:</strong>
						<textarea id="update_description" class="form-control" name="body"></textarea>
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
				getCategories();
			});

			function getCategories(){
				$("#tbl-categories").empty();
				$.get('get-categories', function(data){
					$.each(data,	function(i, value){
						var fila = $('<tr />');
						fila.append($('<td />', {
							text : value.id
						})).append($('<td />', {
							text : value.name
						})).append($('<td />', {
							text : value.slug
						})).append($('<td />', {
							text : value.body
						})).append($('<td />', {
							html : '<a class="btn btn-sm btn-warning" href="" id="edit" data-id=' + value.id + ' >' +
									'<i class="fas fa-edit"></i> Editar</a>' +
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' >' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-categories").append(fila);
					});
				});
			}

			//-------------Eliminar categorias-------------

				/*se creo esta funcion para que al dar click al boton elminiar muestre un alert con
				  mensajes para que el usuario de click a la opcion aceptar o cancelar */
		

				$('body').delegate('#tbl-categories #del', 'click', function(e){
					e.preventDefault();		
					//var resp = confirm("¿Desea eliminar el registro?");

					swal({
						title: "Eliminar",
						text: "¿Realmente desea eliminar la categoria?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
						})
						.then((willDelete) => {
						if (willDelete) {
							var id = $(this).data('id');
							$.post('{{route("categories.destroy", ' + id + ')}}', {id:id}, function(data){
								$(+id).remove();
							});
							getCategories();
							swal("Poof! La categoria se eliminó correctamente!", {
							icon: "success",
							});
						} else {
							swal("¡Operación cancelada por el usuario!");
						}
					});
				});
			
			//-------------Editar categorias-------------

			$('body').delegate('#tbl-categories #edit', 'click', function(e){
				e.preventDefault();
				var id = $(this).data('id');
				//console.log(id);
				$.get('categories/' + id + '/edit', {id:id}, function(data){
					$('#frm-update').find('#update_name').val(data.name)
					$('#frm-update').find('#update_categoryslug').val(data.slug)
					$('#frm-update').find('#update_body').val(data.body)
					$('#frm-update').find('#update_id').val(data.id)
					$('#update_category_modal').modal('show');
				});
			});

			//-------------Actualizar categorias-------------

				$('#frm-update').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var id 		= $('#update_id').val();
				$.ajax({
					type 	: 'put',
					url 	: 'categories/' + id,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{
						$('#update_category_modal').modal('hide');
						getCategories();
					}
					});
				});
		

			//-----------Crear Categoria --------
			

			$('#frm-insert').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var url 	= $(this).attr('action');
				var post 	= $(this).attr('method');
				$.ajax({
					type 	: post,
					url 	: url,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{ 
						$('#add_new_category_modal').modal('hide');
						getCategories();
						$.toast({
							heading: 'Information',
							text: '¡Categoria creada exitosamente!',
							icon: 'info',
							position: 'top-right',
							loader: true,        // Change it to false to disable loader
							loaderBg: '#9EC600'  // To change the background
						});
					}
				});
			});
			
	</script>
@endsection
