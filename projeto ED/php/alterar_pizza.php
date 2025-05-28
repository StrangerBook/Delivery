<?php
// Conexão com o banco de dados
require_once("../includes/conectarBD.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Painel de Pizza</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-warning bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Forno de Pizza</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="painel.php">Painel de Pizzas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Espaço para navbar fixa -->
<div style="margin-top: 100px"></div>

<?php
// Verifica se o formulário não foi enviado
if (!isset($_POST["enviar"])) {

    // Recebe o id do sabor
    $idSabor = $_POST["idSabor"];
    // Consulta os dados do sabor
    $consulta = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel WHERE idSabor='$idSabor'");

    // Conta quantas linhas retornou
    $linha = mysqli_num_rows($consulta);
    if ($linha == 0)
    {
        echo "Sabor não encontrado $idSabor";
        echo "<br>";
        echo "<b><a href='painel.php'><b>Voltar para a Painel </a><br/>";
    }

    // Pega os dados da consulta
    $campoSabor = mysqli_fetch_row($consulta);
    $nomeSabor = $campoSabor[1];
    $descSabor = $campoSabor[2];
    $precoSabor = $campoSabor[3];
    ?>

<!-- Formulário de edição -->
<div class="container text-center">
    <div class="row">
        <div class="col">
            <p id="textogrande" style="font-size: 30px;">Alterar Pizza</p>
        </div>
    </div>
</div>

<div class="container text-center">

    <form class="form-floating" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <p style="font-size: 15px;"><b>Código da pizza: <?php echo $idSabor ?></b></p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Pizza" name="nomeSabor" value="<?php echo $nomeSabor ?>">
            <label for="floatingInput">Nome do Sabor</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="30,00" name="precoSabor" maxlength="6" value="<?php echo $precoSabor ?>" oninput="formatarPreco(this)">
            <label for="floatingInput">Preço</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Descrição" id="floatingTextarea" name="descSabor" value="<?php echo $descSabor ?>"><?php echo $descSabor ?></textarea>
            <label for="floatingTextarea">Descrição</label>
        </div>
        <input type="hidden" name="idSabor" value="<?php echo $idSabor ?>">
        <input type="hidden" name="enviar" value="S">
        <button type="subimit" class="btn btn-warning">Enviar</button>
    </form>
</div>

<?php
    // Fecha conexão
    mysqli_close($conexao);
} else {
    // Recebe dados do formulário enviado
    $idSabor = $_POST["idSabor"];
    $nomeSabor = $_POST["nomeSabor"];
    $descSabor = $_POST["descSabor"];
    $precoSabor = $_POST["precoSabor"];

    // Atualiza dados no banco
    $alterarSabor = mysqli_query($conexao, "UPDATE saborpizpainel SET nomeSabor='$nomeSabor', descSabor='$descSabor', precoSabor = '$precoSabor' WHERE idSabor='$idSabor'");
    ?>

<!-- Exibe dados atualizados -->
<div class="container text-center border border-warning">
    <div class="row">
        <div class="col">
            <p style="font-size: 25px;">Nome</p>
        </div>
        <div class="col">
            <p style="font-size: 25px;">Preço</p>
        </div>
        <div class="col">
            <p style="font-size: 25px;">Descrição</p>
        </div>
    </div>

<div style="margin-top: 30px"></div>

    <div class="row">
        <div class="col">
            <?php echo "<p>$nomeSabor</p>"; ?>
        </div>
        <div class="col">
            <?php echo "<p>$descSabor</p>"; ?>
        </div>
        <div class="col">
            <?php echo "<p>R$ $precoSabor</p>"; ?>
        </div>
    </div>

<div style="margin-top: 30px"></div>

    <div class="row">
        <div class="col">
            <form action="painel.php">
                <button type="submit" class="btn btn-warning">Voltar para o Painel</button>
            </form>
        </div>
    </div>
</div>

<?php
}
?>

</body>
<!-- Scripts JS -->
<script src="../JavaScript/add_pizza.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>
