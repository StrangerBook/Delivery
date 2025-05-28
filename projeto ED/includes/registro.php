<?php
// Inclui conexões com o banco usando duas formas diferentes
include_once ("../includes/conectarBD.php");
include_once ("../includes/conectarBDMysqli.php");

// Inicializa variável para mensagens ao usuário
$mensagem = '';

// Verifica se os dados necessários foram enviados via POST
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    // Recebe dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    // Criptografa a senha antes de salvar
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Prepara consulta para verificar se e-mail já existe
    $stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Se e-mail já cadastrado, define mensagem de erro
    if ($stmt->num_rows > 0) {
        $mensagem = "Esse e-mail já está cadastrado!";
    } else {
        // Insere os dados do novo usuário no banco de forma segura
        $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha);

        // Executa inserção e define mensagem de sucesso ou erro
        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar: " . $mysqli->error;
        }
    }
    // Fecha o statement
    $stmt->close();
}
?>
