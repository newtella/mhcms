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
							<th class="text-center">Name</th>
							<th class="text-center">Slug</th>
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
	 				<form id="frm_new_category" action="{{route('categories.store')}}" method="POST" id="frm-insert">

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
<!-- 
	<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
	            <div class="modal-body">
	 
	                <div class="form-group">
	                    <label for="update_nombre">Nombre</label>
	                    <input type="text" id="update_nombre" placeholder="Nombre" class="form-control"/>
	                </div>
	 
	                <div class="form-group">
	                    <label for="update_apellidos">Apellidos</label>
	                    <input type="text" id="update_apellidos" placeholder="Apellidos" class="form-control"/>
	                </div>

	                <div class="form-group">
	                    <label for="update_direccion">Dirección</label>
	                    <input type="text" id="update_direccion" placeholder="Dirección" class="form-control"/>
	                </div>
	 
	                <div class="form-group">
	                    <label for="update_email">Correo electronico</label>
	                    <input type="text" id="update_email" placeholder="Correo electronico" class="form-control"/>
	                </div>
	 
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary" onclick="updateRecord()" >Actualizar</button>
	                <input type="hidden" id="hidden_usuario_id">
	            </div>
	        </div>
	    </div>
	</div> -->
	<!-- // Modal actualizar registro -->
@endsection
	@section('script')

		<script type="text/javascript">

			$(document).ready(function(){
				getCategories();
			});

			function getCategories(){
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
									' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' onclick="return confirm(\'¿ Desea eliminar la categoria?\')">' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-categories").append(fila);
					});
				});
			}

			//-------------Eliminar categorias-------------

			$('body').delegate('#tbl-categories #del', 'click', function(e){
				var id = $(this).data('id');
				$.post('{{ URL::to("categories/destroy") }}', {id:id}, function(data){
					$(+id).remove();
				});
			});

			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('#frm_new_category').on('submit', function(e){
				e.preventDefault();
				var data 	= $(this).serialize();
				var url 	= $(this).attr('action');
				var post 	= $(this).attr('method');
				
				console.log(data.length)
				$.ajax({

					type 	: post,
					url 	: url,
					data 	: data,
					dataType: 'json',
					success:function(data)
					{
<<<<<<< HEAD
						$('#add_new_category_modal').modal('hide');
=======
						location.reload();
						console.log(data)
						$('#add_new_category_modal').modal('hide');
						

>>>>>>> 959c2089d9fa4c0376633572d99ae3cee3fa35d0
					}
				})

			});
	

	</script>
@endsection
