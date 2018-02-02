@extends('layouts.admin.app')
@section('content')
<h3>Comentarios</h3>


<button data-toggle="modal" data-target="#myForm" class="btn btn-success pull-right">
				<i class="fas fa-plus"></i> Nuevo Registro</button>
			
				<table class="table table-stripped table-bordered table-responsive">
					<thead>
						<tr >
							<th class="text-center">No.</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Email</th>
							<th class="text-center">Comentario</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead> 
					<tbody id="tbl-comentarios">
						
					</tbody>
					
				</table>
				<div class="text-right"></div>



@endsection

@section('script')
		<script type="text/javascript">
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

	$('#myForm').on('submit', function(e){
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
		$.toast({
			heading: 'Information',
			text: '¡Comentario creado exitosamente!',
			icon: 'info',
			position: 'top-right',
			loader: true,        // Change it to false to disable loader
			loaderBg: '#9EC600'  // To change the background
		});
		
	  }
	 });
	});

	$(document).ready(function(){
				getComments();
			});

			function getComments(){
				$("#tbl-comentarios").empty();
				$.get('get-comments', function(data){
					$.each(data,	function(i, value){
						var fila = $('<tr />');
						fila.append($('<td />', {
							text : value.id
						})).append($('<td />', {
							text : value.name
						})).append($('<td />', {
							text : value.email
						})).append($('<td />', {
							text : value.body
						})).append($('<td />', {
							html :' <a  class="btn btn-sm btn-danger" href="" id="del" data-id=' + value.id + ' >' +
									'<i class="fas fa-trash"></i> Eliminar</a>'
						}).css('width','172px'));
						$("#tbl-comentarios").append(fila);
					});
				});
			}
   </script>
   @endsection