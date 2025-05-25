<?php
include_once 'conexao.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo ao painel, <?php echo $_SESSION ['nome']; ?></h1>
</body>
</html>