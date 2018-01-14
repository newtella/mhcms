@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class=""></div>
            <img src="https://i.pinimg.com/736x/06/70/d0/0670d0a78996a2d944d5d9983d089190--munchkin-cat-baby-kitty.jpg" alt="..." class="img-circle center-block imgprofile">
            <p class="text-center">
                <a href="mailto:{{ Auth::user()->email}}" class="">Bienvenido, {{ Auth::user()->username}}</a>
            </p>
                <div class="toptitle well">
                    <div class="marginbottom list-group">
                        <h4 class="text-muted"><i class="fas fa-address-card"></i> Administraci&oacute;n</h4>
                    <a href="" class="list-group-item"> <i class="fas fa-newspaper"></i> Articulos</a>
                    <a href="" class="list-group-item"> <i class="fas fa-comments"></i> Comentarios</a>
                    <a href="" class="list-group-item"> <i class="fas fa-tags"></i> Etiquetas</a>
                    <a href="" class="list-group-item"> <i class="fas fa-list"></i> Categorias</a>
                </div>
                <div class="list-group">
                <h4 class="toptitle2 text-muted"><i class="fas fa-cog fa-spin"></i> Configuraci&oacute;n</h4>
                    <a href="" class="list-group-item"> <i class="fas fa-users"></i> Usuarios</a>
                    <a href="" class="list-group-item"> <i class="fas fa-database"></i> Copia BD</a>
                    <a href="" class="list-group-item"> <i class="fas fa-sync-alt"></i> Restaurar BD</a>
                </div>
            </div>
        </div>
    </div>


    <div id="listdatatbl" class="col-md-9">

    <!-- Contenido del datatable -->
    </div>

</div>



@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#listdatatbl').DataTable( {
        "ajax": "data/objects.txt",
        "columns": [
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "extn" },
            { "data": "start_date" },
            { "data": "salary" }
        ]
    } );
} );

</script>



@endsection