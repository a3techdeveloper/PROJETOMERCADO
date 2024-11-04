$(function(){
   
   $('#novo-produto').on('click', function(){
      $('#formulario')[0].reset();
      $('#pro').val('Cadastro');
      $('#edi').hide();
      $('#reg').show();
      $('#registra-produto').modal({
         show:true,
         backdrop:'static'
      });
   });
   
   $('#busca-prod').on('keyup', function(){ 
      var dado = $('#busca-prod').val();
      var url = '../php/busca_produto.php';
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

function modificaRegistro(){
    var url = '../php/modifica_produto.php';
    $.ajax({
       type:'POST',
       url:url,
       data:$('#formulario').serialize(),
       success: function(registro){
           if($('#pro').val() == 'Cadastro'){
               $('#formulario')[0].reset();
               $('#mensagem').addClass('sucesso').html('Cadastrado com sucesso').show(200).delay(2500).hide(200);
               $('#agrega-registros').html(registro);
               return false;
           }else{
               $('#mensagem').addClass('sucesso').html('Editado com sucesso').show(200).delay(2500).hide(200);
               $('#agrega-registros').html(registro);
               return false;
           }
       }
    });
    return false;
}

function editarProduto(id){
    $('#formulario')[0].reset();
    var url = '../php/edita_produto.php';
    $.ajax({
       type:'POST',
       url:url,
       data:'id='+id,
       success:function(valores){
           var dados = eval(valores);
           $('#reg').hide();
           $('#edi').show();
           $('#pro').val('Edição');
           $('#id-prod').val(id);
           $('#nome').val(dados[0]);
           $('#tipo').val(dados[1]);
           $('#preco-uni').val(dados[2]);
           $('#preco-rev').val(dados[3]);
           $('#registra-produto').modal({
               show:true,
               backdrop:'static'
           });
           return false;
       }
    });
    return false;
}

function deletarProduto(id){
    var url = '../php/deleta_produto.php';
    var pergunta = confirm('Tem certeza que deseja excluir este produto?');
    if(pergunta == true){
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success:function(registro){
                $('#agrega-registros').html(registro);
                return false;
            }
        });
        return false;
    }else{
        return false;
    }
}