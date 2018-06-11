$(document).ready(function(){



});


function searchRegistro(e){
    e.preventDefault();
    var url = "php/sxf.php"
    var formData = new FormData($('#form_consult')[0])

    $.ajax({
        type:'POST',
        url:url,
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){
            $('#loadContent').html(data);
        }
    });
}