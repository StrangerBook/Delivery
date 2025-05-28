<?php
// Inclui o arquivo de conexão com o banco de dados
require_once("../includes/conectarBD.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define o conjunto de caracteres -->
    <meta charset="UTF-8">
    <!-- Responsividade para dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importa o CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">
    <title>Painel de Pizza</title>
</head>
<body>
<nav class="navbar navbar-warning bg-warning fixed-top">
    <div class="container-fluid">
        <!-- Título da aplicação -->
        <a class="navbar-brand" href="#">Forno de Pizza</a>
        
        <!-- Botão de menu responsivo -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu lateral offcanvas -->
        <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                <!-- Botão para fechar o menu -->
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Links de navegação -->
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

<!-- Espaçamento para não ficar atrás da navbar -->
<div style="margin-top: 100px"></div>


    <div style="margin-top: 100px"></div>

<?php
// Recebe os dados do formulário via método POST
$nomeSabor = $_POST["nomeSabor"];
$descSabor = $_POST["descSabor"];
$precoSabor = $_POST["precoSabor"];

// Insere os dados no banco de dados
$sql = mysqli_query($conexao, "INSERT INTO saborpizpainel (nomeSabor, descSabor, precoSabor) 
VALUES ('$nomeSabor', '$descSabor', '$precoSabor')") 
or die("Erro no comando SQL!!!<br/> 
<b><a href='add_pizza.php'><b>Voltar Para a Inclusão de Sabores</a><br/>" . mysqli_error($conexao));

// Exibe uma mensagem de sucesso (a string está vazia mas a confirmação aparece depois)
echo "";
?>


<!-- Mensagem de sucesso com nome do sabor -->
<div align=center style="font-size: 20px;">
    Os dados do Sabor <?php echo "<b>$nomeSabor</b>"?> foram cadastrados com sucesso!!! Veja abaixo os dados cadastrados.<br/><br/>
</div>

<div style="margin-top: 30px"></div>

<div class="container text-center border border-warning">
    <!-- Cabeçalhos -->
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

    <!-- Valores inseridos -->
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

    <!-- Botão para voltar ao painel -->
    <div class="row">
        <div class="col">
            <form action="painel.php">
                <button type="submit" class="btn btn-warning">Voltar para o Painel</button>
            </form>
        </div>
    </div>
</div>



<!-- Script do Bootstrap para funcionalidades como o menu offcanvas -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>

</body>
</html>