<?php
// Inicia a sessão
session_start();

// Inclui a conexão com o banco
include_once("../includes/conectarBDMysqli.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recupera o ID do usuário da sessão
    $usuario_id = $_SESSION['usuario_id'];

    // Captura os dados do formulário
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $referencia = $_POST['referencia'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];

    // Verifica se já existe endereço para o usuário
    $stmt_check = $mysqli->prepare("SELECT id FROM enderecos WHERE usuario_id = ?");
    $stmt_check->bind_param("i", $usuario_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    // Se já existe, atualiza
    if ($stmt_check->num_rows > 0) {
        $stmt = $mysqli->prepare("UPDATE enderecos SET endereco=?, numero=?, complemento=?, referencia=?, bairro=?, cidade=?, estado=?, pais=? WHERE usuario_id=?");
        $stmt->bind_param("ssssssssi", $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $pais, $usuario_id);
    } 
    // Se não existe, insere novo
    else {
        $stmt = $mysqli->prepare("INSERT INTO enderecos (usuario_id, endereco, numero, complemento, referencia, bairro, cidade, estado, pais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $usuario_id, $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $pais);
    }

    // Executa a query
    $stmt->execute();
    $stmt->close();

    // Redireciona após salvar
    header("Location: finalizacao.php");
    exit();
}
?>



<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Metadados -->
  <meta charset="UTF-8">
  <title>Escolha a forma de envio</title>

  <!-- Bootstrap e CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/estiloendereço.css">
</head>
<body>

  <!-- Container principal -->
  <div class="container mt-4">

    <!-- Formulário de endereço -->
    <form action="salvar_endereco.php" method="POST" class="form-section shadow-sm p-4">
      <h5 class="titulo-envio"><i class="bi bi-geo-alt-fill"></i> Escolha a forma de envio</h5>

      <!-- Campo Endereço -->
      <div class="mb-2">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control" name="endereco" required>
      </div>

      <!-- Campo Número -->
      <div class="mb-2">
        <label class="form-label">Número</label>
        <input type="text" class="form-control" name="numero" required>
      </div>

      <!-- Linha com Complemento e Referência -->
      <div class="row">
        <div class="col-md-6 mb-2">
          <label class="form-label">Complemento</label>
          <input type="text" class="form-control" name="complemento">
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">Referência</label>
          <input type="text" class="form-control" name="referencia">
        </div>
      </div>

      <!-- Linha com Bairro e Cidade -->
      <div class="row">
        <div class="col-md-6 mb-2">
          <label class="form-label">Bairro</label>
          <input type="text" class="form-control" name="bairro" required>
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">Cidade</label>
          <input type="text" class="form-control" name="cidade" required>
        </div>
      </div>

      <!-- Linha com Estado e País -->
      <div class="row">
        <div class="col-md-6 mb-2">
          <label class="form-label">Estado</label>
          <input type="text" class="form-control" name="estado" required>
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">País</label>
          <input type="text" class="form-control" name="pais" required>
        </div>
      </div>

      <!-- Botão de Enviar -->
      <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-check-circle-fill"></i> Confirmar Endereço
        </button>
      </div>
    </form>
  </div>

  <!-- Script Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
