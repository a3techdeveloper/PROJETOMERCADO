<?php
//inclui arquivo de conexão
include_once 'conecta_1.php';

//Recebe a requisição
$dado = filter_input(INPUT_POST, 'dado');

//Cria a instrução SQL 
$query = "SELECT * FROM tb_venda WHERE nome_cliente LIKE '$dado%' ORDER BY id ASC";

//Executa o SQL
$result = mysqli_query($link, $query);

//Criamos a tela e devolvemos ao AJAX
?>
<table class="table table-striped table-hover">
    <tr>
        <th width="300">Nome do Cliente</th>
        <th width="300">Roteiro</th>
        <th width="200">Período da Viagem (Data Inicial)</th>
        <th width="150">(Data Final)</th>
        <th width="150">Tipo Fornecedor</th>
    </tr>
    <?php
//Verifica se retornou registro
    if (mysqli_num_rows($result)) {
        //Enquanto estiver percorrendo todos os registros
        while ($linhas = mysqli_fetch_object($result)) {
            ?>
            <tr>
                <td><?=$linhas->nome_cliente?></td>
                    <td><?=$linhas->pacote?></td>
                    <td><?=$linhas->data_inicial?></td>
                    <td><?=$linhas->data_final?></td>
                    <td><?=$linhas->tipo_pacote?></td>             
            </tr>
            <?php
        }
    } else {
        print '<tr><td colspan="5">Nenhum resultado foi encontrado</td></tr>';
    }
    ?>
</table>

