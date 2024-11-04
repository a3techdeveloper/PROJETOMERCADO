<?php

//inclui arquivo de conexão
include_once 'conecta.php';

//Recebe a requisição
$dado = filter_input(INPUT_POST, 'dado');

//Cria a instrução SQL 
$query = "SELECT * FROM produtos WHERE nome_prod LIKE '$dado%' OR tipo_prod LIKE '$dado%' ORDER BY id_prod ASC";

//Executa o SQL
$result = mysqli_query($link, $query);

//Criamos a tela e devolvemos ao AJAX
?>
<table class="table table-striped table-hover">
    <tr>
        <th width="300">Nome</th>
        <th width="200">Tipo</th>
        <th width="150">Preço Unit</th>
        <th width="150">Preço Rev</th>
        <th width="80">Opções</th>
    </tr>
<?php 
//Verifica se retornou registro
if(mysqli_num_rows($result)){
    //Enquanto estiver percorrendo todos os registros
    while($linhas = mysqli_fetch_array($result)){
?>
    <tr>
        <td><?=$linhas["nome_prod"]?></td>
        <td><?=$linhas["tipo_prod"]?></td>
        <td><?=$linhas["preco_unit"]?></td>
        <td><?=$linhas["preco_rev"]?></td>
        <td>
            <?php 
            print '
                <a href="javascript:editarProduto('.$linhas['id_prod'].');" class="glyphicon glyphicon-edit"></a>
                <a href="javascript:deletarProduto('.$linhas['id_prod'].');" class="glyphicon glyphicon-remove-circle"></a>    
                ';
            ?>
        </td>
    </tr>
<?php    
    }
}else{
    print '<tr><td colspan="5">Nenhum resultado foi encontrado</td></tr>';
}
?>
</table>

