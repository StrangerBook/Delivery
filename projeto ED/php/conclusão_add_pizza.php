<?php
require_once("../includes/conectarBD.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Painel de Pizza</title>
</head>
<body>

<nav class="navbar navbar-warning bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" >Forno de Pizza</a>
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

    <div style="margin-top: 100px"></div>

<?php

    
    $nomeSabor = $_POST["nomeSabor"];
    $descSabor = $_POST["descSabor"];
    $precoSabor = $_POST["precoSabor"];
    

    $sql = mysqli_query($conexao, "INSERT INTO saborpizpainel (nomeSabor, descSabor, precoSabor) VALUES ('$nomeSabor', '$descSabor', '$precoSabor')") or die("Erro no
comando SQL!!!<br/> <b><a href='add_pizza.php'><b>Voltar Para a
Inclusão de Sabores</a><br/>" . mysqli_error($conexao));
    echo "";
?>

<div align=center style="font-size: 20px;">Os dados do Sabor <?php echo "<b>$nomeSabor</b>"?> foram
cadastrados com sucesso!!! Veja abaixo os dados cadastrados.<br/><br/></div>

<div style="margin-top: 30px"></div>

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


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>