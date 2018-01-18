$(document).ready( function(){
console.log("gggg");
    $('#summernote').summernote({
        

        height: 300,

   });

   $('#titulo').on('change', function(){
        
    var title = $('#titulo').val();
    title = title.toLowerCase();
    var slug = replaceAll(title,' ','-');
 
    
    $('#slug').val(slug);


   });
   
   function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
    }




});



/*
--- Usuario
*/
// Agregar registro

function loadPage(url)
{
    var arrayUrl = url.split('/');
    $.get(url, {}, function (data, status) {
        $("#content_primary").html(data);
        readRecords(arrayUrl[1]);
    });
}

function readRecords(modelo) {
    $.get("ajax/" + modelo + "/Listar.php", {}, function (data, status) {
        $(".records_content").html(data);
    });

    
}



function addPost() {
     var url = "/articles";
    // var arrayUrl = url.split('/');  

    var titulo = $("#titulo").val();
   // titulo = titulo.trim();
    var slug = $("#slug").val();
   // slug = slug.trim();
    var categoria = $("#categoria").val();
   // categoria = categoria.trim();
    var tag = $("#tag").val();
   // tag = tag.trim();
    
 
    if (titulo == "") {
        alert("El campo nombre es requerido!");
    }
    else if (slug == "") {
        alert("El campo slug es requerido!");
    }
    else if (categoria == "") {
        alert("El campo categoria es requerido!");
    }
    else if (tag == "") {
        alert("El campo tag es requerido!");
    }
    
    
    else {
        // Agregar registro
        $.post(url, {
            titulo: titulo,
            slug: slug,
            categoria: categoria,
            tag: tag
        }, function () {
            // cerramos el formulario modal
            $("#add_new_record_modal").modal("hide");
 
            // volvemos a leer los registros
            //readRecords(arrayUrl[0]);

            // limpiamos los campos del formulario modal
            $("#title").val("");
            $("#slug").val("");
            $("#categoria").val("");
            $("#tag").val("");
        });
    }
}









function addUser() {
    var url = "ajax/user/Crear.php";
    var arrayUrl = url.split('/');  

    var nombre = $("#nombre").val();
    nombre = nombre.trim();
    var apellidos = $("#apellidos").val();
    apellidos = apellidos.trim();
    var direccion = $("#direccion").val();
    direccion = direccion.trim();
    var email = $("#email").val();
    email = email.trim();
 
    if (nombre == "") {
        alert("El campo nombre es requerido!");
    }
    else if (apellidos == "") {
        alert("El campo apellidos es requerido!");
    }
    else if (direccion == "") {
        alert("El campo apellidos es requerido!");
    }
    else if (email == "") {
        alert("El campo correo electronico es requerido!");
    }
    else {
        // Agregar registro
        $.post(url, {
            nombre: nombre,
            apellidos: apellidos,
            direccion: direccion,
            email: email
        }, function (data, status) {
            // cerramos el formulario modal
            $("#add_new_record_modal").modal("hide");
 
            // volvemos a leer los registros
            readRecords(arrayUrl[1]);

            // limpiamos los campos del formulario modal
            $("#nombre").val("");
            $("#apellidos").val("");
            $("#direccion").val("");
            $("#email").val("");
        });
    }
}

// Obtener registros
/* function readRecords() {
    $.get("ajax/user/Listar.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
} */



function getUser(id) {
    var url = "ajax/user/Detalle.php";
    var arrayUrl = url.split('/');

    // Obtenemos el id del campo oculto
    $("#hidden_usuario_id").val(id);
    $.post(url, {
            id: id
        },
        function (data, status) {
            // convertimos la info a JSON
            var usuario = JSON.parse(data);
            // asignamos los valores existentes a los campos del modal
            $("#update_nombre").val(usuario.nombre);
            $("#update_apellidos").val(usuario.apellidos);
            $("#update_direccion").val(usuario.direccion);
            $("#update_email").val(usuario.email);
            $("#hidden_usuario_id").val(usuario.id);
        }
    );
    // Abrimos el modal
    $("#update_user_modal").modal("show");
}

function updateUser() {
    var url = "ajax/user/Editar.php";
    var arrayUrl = url.split('/');

    // obtenemos los valores
    var nombre = $("#update_nombre").val();
    nombre = nombre.trim();
    var apellidos = $("#update_apellidos").val();
    apellidos = apellidos.trim();
    var direccion = $("#update_direccion").val();
    direccion = direccion.trim();
    var email = $("#update_email").val();
    email = email.trim();
 
    if (nombre == "") {
        alert("El campo nombre es requerido!");
    }
    else if (apellidos == "") {
        alert("El campo apellidos es requerido!");
    }
    else if (direccion == "") {
        alert("El campo apellidos es requerido!");
    }
    else if (email == "") {
        alert("El campo correo electronico es requerido!");
    }
    else {
        // obtenemos el dato del campo oculto
        var id = $("#hidden_usuario_id").val();
 
        // Actualizamos los datos por medio de ajax
        $.post(url, {
                id: id,
                nombre: nombre,
                apellidos: apellidos,
                direccion: direccion,
                email: email
            },
            function (data, status) {
                // ocultamos la ventana modal
                $("#update_user_modal").modal("hide");
                // recargamos los registros utilizando readRecords();
                readRecords(arrayUrl[1]);
            }
        );
    }
}

function deleteUser(id) {
    var url = "ajax/user/Eliminar.php";
    var arrayUrl = url.split('/');

    var conf = confirm("Esta seguro de borrar este registro?");
    if (conf == true) {
        $.post(url, {
                id: id
            },
            function (data, status) {
                // recargamos los registros utilizando readRecords();
                readRecords(arrayUrl[1]);
            }
        );
    }
}