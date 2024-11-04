<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mercado Coma-Bem</title>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery.js" type="text/javascript"></script>
        <script src="../js/myjava.js" type="text/javascript"></script>
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
    </head>
    <body>
        <header>Mercado Coma-Bem</header>
        <section>
            <table border="0" align="center">
                <tr>
                    <td width="400"><input type="text" placeholder="Busca um produto por: Nome ou Tipo" id="busca-prod"></td>
                    <td width="100"><button id="novo-produto" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span>
                            Novo Produto
                        </button>
                    </td>
                    <td width="200"></td>
                </tr>
            </table>
        </section>
        <div class="registros" id="agrega-registros">
            <table class="table table-striped table-hover">
                <tr>
                    <th width="300">Nome</th>
                    <th width="200">Tipo</th>
                    <th width="150">Preço Unit</th>
                    <th width="150">Preço Rev</th>
                    <th width="80">Opções</th>
                </tr>
                <?php 
                    //Inclui arquivo de conexão
                    include_once '../php/conecta.php';
                    //Cria a instrução SQL
                    $query = "SELECT * FROM produtos ORDER BY id_prod ASC";
                    //Executa a instrução
                    $result = mysqli_query($link, $query);
                    //Enquanto percorre todos os registros
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
                <?php  } ?>
            </table>
        </div>
        <!-- Janela Modal para o gerenciamento de produtos -->
        <div class="modal fade" id="registra-produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><b>Gerencia Produto</b></h4>
                    </div>
                    <form id="formulario" class="formulario" onsubmit="return modificaRegistro();">
                        <div class="modal-body">
                            <table border="0" width="100%">
                                <tr>
                                    <td colspan="2"><input type="text" required readonly id="id-prod" name="id-prod" style="visibility: hidden; height: 5px"></td>
                                </tr>
                                <tr>
                                    <td width="150">Processo:</td>
                                    <td><input type="text" required readonly id="pro" name="pro"></td>
                                </tr>
                                <tr>
                                    <td>Nome:</td>
                                    <td><input type="text" required name="nome" id="nome" maxlength="100"></td>
                                </tr>
                                <tr>
                                    <td>Tipo:</td>
                                    <td>
                                        <select required name="tipo" id="tipo">
                                            <option value="enlatado">Enlatados</option>
                                            <option value="organico">Orgânicos</option>
                                            <option value="naocomestivel">Não Comestíveis</option>
                                            <option value="outro">Outros</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Preço Unitário:</td>
                                    <td><input type="text" required name="preco-uni" id="preco-uni"></td>
                                </tr>
                                <tr>
                                    <td>Preço Revenda:</td>
                                    <td><input type="text" required name="preco-rev" id="preco-rev"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div id="mensagem"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Registrar" class="btn btn-success" id="reg">
                            <input type="submit" value="Editar" class="btn btn-warning" id="edi">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
