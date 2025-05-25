<?php
include_once 'conexao.php';

$mensagem = '';

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Verifica se o e-mail já está cadastrado (usando bind_param corretamente)
    $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $mensagem = "Esse e-mail já está cadastrado!";
    } else {
        // Insere os dados de forma segura
        $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha);

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar: " . $mysqli->error;
        }
    }
    $stmt->close();
}
?>
