<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tela - Cadastro de Reservas</title>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery.js" type="text/javascript"></script>
        <script src="../js/myjava_1.js" type="text/javascript"></script>
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
    </head>
    <body>
        <header>Cadastro - Reservas</header>
        <section>
            <table border="0" align="center">
                <tr>
                    <td width="400"><input type="text" placeholder="Busca por: Nome do Cliente" id="busca-cliente"></td>                    
                    <td width="200"></td>
                </tr>
            </table>
        </section>
        <div class="registros" id="agrega-registros">
            <table class="table table-striped table-hover">
                <tr>
                    <th width="300">Nome do Cliente</th>
                    <th width="300">Roteiro</th>
                    <th width="200">Período da Viagem (Data Inicial)</th>
                    <th width="150">(Data Final)</th>
                    <th width="150">Tipo Fornecedor</th>
                </tr>
                <?php 
                    //Inclui arquivo de conexão
                    include_once '../php/conecta_1.php';
                    //Cria a instrução SQL
                    $query = "SELECT * FROM tb_venda ORDER BY id ASC";
                    //Executa a instrução
                    $result = mysqli_query($link, $query);
                    //Enquanto percorre todos os registros
                    while($linhas = mysqli_fetch_object($result)){
                ?>
                <tr>
                    <td><?=$linhas->nome_cliente?></td>
                    <td><?=$linhas->pacote?></td>
                    <td><?=$linhas->data_inicial?></td>
                    <td><?=$linhas->data_final?></td>
                    <td><?=$linhas->tipo_pacote?></td>                   
                </tr>
                <?php  } ?>
            </table>
        </div>
    </body>
</html>
