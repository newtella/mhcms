@extends('layouts.admin.app')
@section('content')
<h3>Roles</h3>

	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
			<button data-toggle="modal" data-target="#add_new_rol_modal" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro</button>
			
				<table class="table table-stripped table-bordered table-responsive">
					<thead>
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead> 
					<tbody id="tbl-rols">
						
					</tbody>
					
				</table>
				<div class="text-right"></div>

				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
		
	<div class="modal fade" id="add_new_rol_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
	                	<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>
	
	            </div>
	            <div class="modal-body">
	 				<form  action="{{ URL::to('rols')}}" method="POST" id="frm-insert-rol">

	                	<div class="form-group">
	                    	<label for="name_rol">Name</label>
	                    	<input name="name" type="text" id="name_rol" placeholder="Nombre" class="form-control"/>
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
 
	<div class="modal fade" id="update_rol_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
					<div class="modal-body">
					<form  action="" method="POST" id="frm-update-rol">
					<div class="form-group">
						<label for="update_name_rol">Name</label>
						<input name="name" type="text" id="update_name_rol" placeholder="Nombre" class="form-control"/>
					</div>

					<input name="id" type="hidden" id="update_id_rol"  placeholder="" class=""/>

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
				getRols();
			});

			function getRols(){
				$.get('get-rols', function(data){
					$.each(data,	function(i, value){
						var fila = $('<tr />');
						fila.append($('<td />', {
							text : value.id
						})).append($('<td />', {
							text : value.name
						})).append($('<td />', {
							html : '<a class="btn btn-sm btn-warning" href="" id="edit" data-id=' + value.id + ' >' +
									'<i class="fas fa-edit"></i> Editar</a>' +
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' onclick="Confirm()">' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-rols").append(fila);
					});
				});
			}
//-------------Eliminar Roles-------------

				/*se creo esta funcion para que al dar click al boton elminiar muestre un alert con
				  mensajes para que el usuario de click a la opcion aceptar o cancelar */
			
				  function Confirm() {				
					//Ingresamos un mensaje a mostrar
					var id = confirm("¿Desea eliminar el registro?");
	
						//Detectamos si el usuario acepto el mensaje
						if (id) {
							$('body').delegate('#tbl-rols #del', 'click', function(e){
								var id = $(this).data('id');
									$.post('rols/' + id , {id:id}, function(data){
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
	
	
			//-------------Editar ROles-------------

			$('body').delegate('#tbl-rols #edit', 'click', function(e){
				e.preventDefault();
				var id = $(this).data('id');
				//console.log(id);
				$.get('rols/' + id + '/edit', {id:id}, function(data){
					$('#frm-update-rol').find('#update_name_rol').val(data.name)
					$('#frm-update-rol').find('#update_id_rol').val(data.id)
					$('#update_rol_modal').modal('show');
				});
			});

			//-------------Actualizar Roles-------------

				$('#frm-update-rol').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var id 		= $('#update_id_rol').val();
				$.ajax({
					type 	: 'put',
					url 	: 'rols/' + id,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{ 
						location.reload();
						$('#update_rol_modal').modal('hide');
					}
					});
				});
		

			//-----------Crear Roles--------
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('#frm-insert-rol').on('submit', function(e){
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
						location.reload();
						$('#add_new_rol_modal').modal('hide');
					}
					});
				});
			
	</script>
@endsection
