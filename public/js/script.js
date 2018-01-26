$(document).ready( function(){

    $('#summernote').summernote({
        

        height: 300,

    });

    $('#updatesummernote').summernote({
        

        height: 300,

    });
// para poder obtener el slug del nombre del post 

   $('#titulo').on('change', function(){
        
        var title = $('#titulo').val();
        title = title.toLowerCase();
        var slug = replaceAll(title,' ','-');
 
    
        $('#slug').val(slug);


    });

    // para poder obtener el slug del nombre del post al editar

   $('#update_titulo').on('change', function(){
        
    var title = $('#update_titulo').val();
    title = title.toLowerCase();
    var slug = replaceAll(title,' ','-');


    $('#update_slug').val(slug);


});
   
    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
    }


    // para obtener el slug del nombre de la categoria en el Create
    
    $('#name').on('change', function(){
        
        var title = $('#name').val();
        title = title.toLowerCase();
        var slug = replaceAll(title,' ','-');
 
    
        $('#categoryslug').val(slug);

    });
   
    
// para obtener el slug del nombre de la categoria en el Update
    
$('#update_name').on('change', function(){
        
    var title = $('#update_name').val();
    title = title.toLowerCase();
    var slug = replaceAll(title,' ','-');


    $('#update_categoryslug').val(slug);

});


// para obtener el slug del nombre de la Etiqueta en el Create
    
$('#name_tag').on('change', function(){
        
    var title = $('#name_tag').val();
    title = title.toLowerCase();
    var slug = replaceAll(title,' ','-');


    $('#tagslug').val(slug);

});


// para obtener el slug del nombre de la Etiqueta en el Update

$('#update_name_tag').on('change', function(){
    
var title = $('#update_name_tag').val();
title = title.toLowerCase();
var slug = replaceAll(title,' ','-');


$('#update_tagslug').val(slug);

});


});


