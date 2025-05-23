<?php
/* Este script conecta um banco de dados MySQL conforme parâmetros enviados
*/
$nomeServidor = "localhost";
$dbName = "imaginariafil";
$usuario = "root";
$senha = "";
$conexao = mysqli_connect($nomeServidor, $usuario, $senha, $dbName);
// Conectando ao servidor MySQL
if (!($conexao)) {
    die("<pre>" . "Não foi possível conectar-se ao MySQL. Favor contactar o
Administrador. " . mysqli_connect_error());
} else {
    die("<pre>" . "Conexão com a Base de Dados do MySQL $dbName estabelecida
com sucesso !!!!.");
    mysqli_close($conexao);
}
