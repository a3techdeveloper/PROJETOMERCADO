<?php

//Inclui o arquivo de conexão
include_once 'conecta.php';

//Faz requisição do valor
$id = filter_input(INPUT_POST, 'id');

//cria a instrução SQL
$query = "SELECT * FROM produtos WHERE id_prod = '$id'";

//Executa a instrução
$result = mysqli_query($link, $query);

//Armazena os valores em um array
$linha = mysqli_fetch_array($result);

//Organiza os dados em um array pelo índice
$dados = array(
  0 => $linha["nome_prod"],  
  1 => $linha["tipo_prod"],  
  2 => $linha["preco_unit"],  
  3 => $linha["preco_rev"]  
);

print json_encode($dados);
