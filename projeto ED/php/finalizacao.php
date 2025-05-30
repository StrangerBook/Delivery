<?php
// Inicia a sessão
session_start();

// Inclui conexão com o banco de dados
include_once("../includes/conectarBDMysqli.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

// Recupera o ID do usuário da sessão
$usuario_id = $_SESSION['usuario_id'];

// Prepara a consulta para buscar o endereço do usuário
$stmt = $mysqli->prepare("SELECT endereco, numero, complemento, referencia, bairro, cidade, estado, pais FROM enderecos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $pais);
$stmt->fetch();
$stmt->close();

// Monta o endereço completo
$enderecoCompleto = "$endereco, $numero - $bairro, $cidade - $estado, $pais";
if (!empty($complemento)) $enderecoCompleto .= " (Comp: $complemento)";
if (!empty($referencia)) $enderecoCompleto .= " - Ref: $referencia";
?>


<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- Metadados e título -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finalizar Pedido - iFood Clone</title>

  <!-- Bootstrap e CSS customizado -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/estilofinal.css" />
</head>

<body>
  <!-- Container principal -->
  <div class="container mt-4">
    <h1>Resumo do Pedido</h1>

    <!-- Seção de endereço -->
    <section class="card p-3 mb-3">
      <h2>Endereço de Entrega</h2>
      <p><?php echo htmlspecialchars($enderecoCompleto); ?></p>
    </section>

    <!-- Seção de valores -->
    <section class="card p-3 mb-3">
      <h2>Resumo de Valores</h2>
      <div>Subtotal - R$ (preço do alimento e bebida)</div>
      <div>Taxa de Entrega - R$</div>
      <div>Taxa de Serviço - R$</div>
    </section>

    <!-- Seção total -->
    <section class="card p-3">
      <h1>Total</h1>
      <div class="total-price">R$ 0,00</div>
    </section>
  </div>
</body>
</html>

