<?php
session_start();
include_once ("../includes/conectarBD.php");
include_once ("../includes/conectarBDMysqli.php");

$mensagem_login = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $senha = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nome, $senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            header("Location: index.php");
            exit();
        } else {
            $mensagem_login = "Senha incorreta!";
        }
    } else {
        $mensagem_login = "E-mail não encontrado!";
    }

    $stmt->close();
}
?>
