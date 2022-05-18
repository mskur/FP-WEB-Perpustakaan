$(document).ready(function(){

    $('#keyword').on('keyup',function(){
        $.get('../script/search.php?keyword='+$('#keyword').val(),function(data){
            $('#tabelData').html(data);
            $('.').hide();
        });
    });
})