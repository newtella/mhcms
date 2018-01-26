@extends('layouts.admin.app')
@section('content')
<h3>Etiquetas</h3>

	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
			<button data-toggle="modal" data-target="#add_new_tag_modal" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro</button>
			
				<table class="table table-stripped table-bordered table-responsive">
					<thead>
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">URL Amigable</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead> 
					<tbody id="tbl-tags">
						
					</tbody>
					
				</table>
				<div class="text-right"></div>

				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
		
	<div class="modal fade" id="add_new_tag_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
	                	<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>
	
	            </div>
	            <div class="modal-body">
	 				<form  action="{{ URL::to('tags')}}" method="POST" id="frm-insert-tag">

	                	<div class="form-group">
	                    	<label for="name_tag">Name</label>
	                    	<input name="name" type="text" id="name_tag" placeholder="Name" class="form-control"/>
	                	</div>
	 
	                	<div class="form-group">
	                    	<label for="tagslug">Slug</label>
	                   		<input name="slug" type="text" id="tagslug"  placeholder="Slug" class="form-control"/>
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
 
	<div class="modal fade" id="update_tag_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
					<div class="modal-body">
					<form  action="" method="POST" id="frm-update-tag">
					<div class="form-group">
						<label for="update_name_tag">Name</label>
						<input name="name" type="text" id="update_name_tag" placeholder="Name" class="form-control"/>
					</div>

					<div class="form-group">
						<label for="update_tagslug">Slug</label>
							<input name="slug" type="text" id="update_tagslug"  placeholder="Slug" class="form-control"/>
					</div>

					<input name="id" type="hidden" id="update_id_tag"  placeholder="" class=""/>

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
				getTags();
			});


			function getTags(){
				$("#tbl-tags").empty();
				$.get('get-tags', function(data){
					$.each(data,	function(i, value){
						var fila = $('<tr />');
						fila.append($('<td />', {
							text : value.id
						})).append($('<td />', {
							text : value.name
						})).append($('<td />', {
							text : value.slug
						})).append($('<td />', {
							html : '<a class="btn btn-sm btn-warning" href="" id="edit" data-id=' + value.id + ' >' +
									'<i class="fas fa-edit"></i> Editar</a>' +
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' onclick="">' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-tags").append(fila);
					});
				});
			}
//-------------Eliminar categorias-------------

				/*se creo esta funcion para que al dar click al boton elminiar muestre un alert con
				  mensajes para que el usuario de click a la opcion aceptar o cancelar */
			
			$('body').delegate('#tbl-tags #del', 'click', function(e){
				e.preventDefault();			
					swal({
						title: "Eliminar",
						text: "¿Realmente desea eliminar la etiqueta?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
						.then((willDelete) => {
						if (willDelete) {
							var id = $(this).data('id');
									$.post('{{route("tags.destroy", ' + id + ')}}', {id:id}, function(data){
										$(+id).remove();
									});
									getTags()
									swal("Poof! La etiqueta se eliminó correctamente!", {
										icon: "success",
									});
							} 
							else{
								swal("¡Operación cancelada por el usuario!");
							}
						});
			});

			//-------------Editar categorias-------------

			$('body').delegate('#tbl-tags #edit', 'click', function(e){
				e.preventDefault();
				var id = $(this).data('id');
				//console.log(id);
				$.get('tags/' + id + '/edit', {id:id}, function(data){
					$('#frm-update-tag').find('#update_name_tag').val(data.name)
					$('#frm-update-tag').find('#update_tagslug').val(data.slug)
					$('#frm-update-tag').find('#update_id_tag').val(data.id)
					$('#update_tag_modal').modal('show');
				});
			});

			//-------------Actualizar categorias-------------

			$('#frm-update-tag').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var id 		= $('#update_id_tag').val();
				$.ajax({
					type 	: 'put',
					url 	: 'tags/' + id,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{ 
						$('#update_tag_modal').modal('hide');
						getTags()
					}
				});
			});
		

			//-----------Crear Categoria --------
		

			$('#frm-insert-tag').on('submit', function(e){
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
						$('#add_new_tag_modal').modal('hide');
						getTags()
					}
				});
			});
			
	</script>
@endsection
