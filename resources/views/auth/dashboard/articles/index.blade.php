@extends('layouts.admin.app')
	@section('content')
		<h3>Articulos</h3>
			<button data-toggle="modal" data-target="#add_new_record_modal" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro
			</button>

					
				<table class="table table-stripped table-bordered table-responsive">
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Categoria</th>
							<th class="text-center">Usuario</th>
							<th class="text-center">Acciones</th>
						</tr>
					@foreach($articles as $article)
						<tr>
							<td>{{$article->id}}</td>
							<td>{{$article->name}}</td>
							<td>{{$article->category->name}}</td>
							<td>{{$article->user->username}}</td>
							<td width="172px">
								<a class="btn btn-sm btn-warning"href="">
								<i class="fas fa-edit"></i> Editar</a>
								<a class="btn btn-sm btn-danger" href="">
								<i class="fas fa-trash"></i> Eliminar</a>
							</td>
						</tr>
					@endforeach
				</table>
					<div class="text-right">
						{{$articles->render()}}
					</div>
					
				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
	
	<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
	                	<h4 class="modal-title" id="myModalLabel">Agregar registro</h4>
	            </div>
	            <div class="modal-body">
	 				<form id="frm_new_post" action="{{route('articles.store')}}" method="POST" id="frm-insert">

	                	<div class="form-group">
	                    	<label for="titulo">Titulo</label>
	                    	<input name="name" type="text" id="titulo" placeholder="Titulo" class="form-control"/>
	               		</div>
	 
	                	<div class="form-group">
	                    	<label for="slug">Slug</label>
	                    	<input name="slug" type="text" id="slug"  placeholder="Slug" class="form-control"/>
	                	</div>

	               		<div class="form-group">
							<label for="categoria">Categoria</label>
							<select name="category_id" id="categoria" class="selectpicker form-control">
								@foreach($categories as $category)
  									<option value="{{$article->category->id}}">
								  		<td>{{$category->name}}</td>
									</option>
								@endforeach
							</select>
						</div>
					
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
	<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
	            <div class="modal-body">
	 
	                <div class="form-group">
	                    <label for="update_nombre">Titulo</label>
	                    <input type="text" id="update_nombre" placeholder="Nombre" class="form-control"/>
	                </div>
	 
	                <div class="form-group">
	                    <label for="update_apellidos">Slug</label>
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

		$('#frm_new_post').on('submit', function(e){
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
						$('#add_new_record_modal').modal('hide');
						
					}
			})

		});
	</script>
@endsection