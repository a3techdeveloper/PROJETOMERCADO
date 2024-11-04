<?php

//Inclui o arquivo de conexão
include_once 'conecta.php';

//Faz requisição do valor
$id = filter_input(INPUT_POST, 'id');

//Cria a instrução SQL
$query = "DELETE FROM produtos WHERE id_prod = '$id'";

//Executa a instrução
mysqli_query($link, $query);

//Atualizamos os registros e o obtemos
$query = "SELECT * FROM produtos ORDER BY id_prod ASC";
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
    <?php } ?>
</table>