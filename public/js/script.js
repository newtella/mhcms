$(document).ready( function(){
   console.log("gggg");

    $('#summernote').summernote({
        

        height: 300,

    });
// para poder obtener el slug del nombre del post 

   $('#titulo').on('change', function(){
        
        var title = $('#titulo').val();
        title = title.toLowerCase();
        var slug = replaceAll(title,' ','-');
 
    
        $('#slug').val(slug);


    });
   
    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
    }


    // para obtener el slug del nombre de la categoria 
    
    $('#name').on('change', function(){
        
        var title = $('#name').val();
        title = title.toLowerCase();
        var slug = replaceAll(title,' ','-');
 
    
        $('#categoryslug').val(slug);


    });
   
    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
    }
});


