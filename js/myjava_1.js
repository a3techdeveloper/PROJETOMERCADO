$(function(){
    
   $('#busca-cliente').on('keyup', function(){ 
      var dado = $('#busca-cliente').val();
      var url = '../php/busca_cli.php';
      $.ajax({
         type:'POST',
         url:url,
         data:'dado=' + dado,
         success: function(dados){
             $('#agrega-registros').html(dados);
         }
      });
      return false;
   });   
    
});

