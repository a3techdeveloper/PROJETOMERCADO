<?php

//Inclui o arquivo de conexão
include_once 'conecta.php';

//Recebe valores dos campos
$id         = filter_input(INPUT_POST, "id-prod");
$processo   = filter_input(INPUT_POST, "pro");
$nome       = filter_input(INPUT_POST, "nome");
$tipo       = filter_input(INPUT_POST, "tipo");
$preco_uni  = filter_input(INPUT_POST, "preco-uni");
$preco_rev  = filter_input(INPUT_POST, "preco-rev");

//substitui caracteres
$preco_uni = str_replace(',', '.', $preco_uni);
$preco_rev = str_replace(',', '.', $preco_rev);

//Verificamos qual processo selecionado
switch ($processo){
    case 'Cadastro':
        $query = "INSERT INTO produtos(nome_prod, tipo_prod, preco_unit, preco_rev)VALUES('$nome','$tipo','$preco_uni','$preco_rev')";
        mysqli_query($link, $query);
        break;
    case 'Edição':
        $query = "UPDATE produtos SET nome_prod = '$nome', tipo_prod = '$tipo', preco_unit = '$preco_uni', preco_rev = '$preco_rev' WHERE id_prod = '' ";
        mysqli_query($link, $query);
        break;
}

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
