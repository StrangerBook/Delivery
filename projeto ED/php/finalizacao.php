<?php
session_start();
include_once("../includes/conectarBDMysqli.php");

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $mysqli->prepare("SELECT endereco, numero, complemento, referencia, bairro, cidade, estado, pais FROM enderecos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $pais);
$stmt->fetch();
$stmt->close();

$enderecoCompleto = "$endereco, $numero - $bairro, $cidade - $estado, $pais";
if (!empty($complemento)) $enderecoCompleto .= " (Comp: $complemento)";
if (!empty($referencia)) $enderecoCompleto .= " - Ref: $referencia";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finalizar Pedido - iFood Clone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/estilofinal.css" />
</head>

<body>
  <div class="container mt-4">
    <h1>Resumo do Pedido</h1>

    <section class="card p-3 mb-3">
      <h2>Endereço de Entrega</h2>
      <p><?php echo htmlspecialchars($enderecoCompleto); ?></p>
    </section>

    <!-- Aqui você pode incluir mais detalhes do pedido -->
    <section class="card p-3 mb-3">
      <h2>Resumo de Valores</h2>
      <div>Subtotal - R$ (preço do alimento e bebida)</div>
      <div>Taxa de Entrega - R$</div>
      <div>Taxa de Serviço - R$</div>
    </section>

    <section class="card p-3">
      <h1>Total</h1>
      <div class="total-price">R$ 0,00</div>
    </section>
  </div>
</body>
</html>
