<?php
// Inicia a sessão
session_start();

// Encerra a sessão
session_destroy();

// Redireciona para a página inicial
header("Location: index.php");

// Encerra a execução do script
exit();
?>