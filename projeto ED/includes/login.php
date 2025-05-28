<?php
// Inicia sessão para armazenar dados do usuário
session_start();

// Inclui conexões com banco de dados
include_once ("../includes/conectarBD.php");
include_once ("../includes/conectarBDMysqli.php");

// Variável para mensagens de erro ou status no login
$mensagem_login = '';

// Verifica se o método da requisição é POST e se os campos email e senha foram enviados
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['password'])) {
    // Limpa e recebe os dados enviados pelo formulário
    $email = trim($_POST['email']);
    $senha = $_POST['password'];

    // Prepara a consulta para buscar o usuário pelo email
    $stmt = $mysqli->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verifica se o usuário foi encontrado
    if ($stmt->num_rows === 1) {
        // Associa os resultados às variáveis
        $stmt->bind_result($id, $nome, $senha_hash);
        $stmt->fetch();

        // Verifica se a senha digitada confere com o hash armazenado
        if (password_verify($senha, $senha_hash)) {
            // Login válido: armazena dados na sessão e redireciona para página inicial
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            header("Location: index.php");
            exit();
        } else {
            // Senha incorreta
            $mensagem_login = "Senha incorreta!";
        }
    } else {
        // E-mail não encontrado no banco
        $mensagem_login = "E-mail não encontrado!";
    }

    // Fecha o statement
    $stmt->close();
}
?>
