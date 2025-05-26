<?php

require_once("../includes/conectarBD.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">
    <title>Document</title>
</head>

<body>

    <header>
        <div class="logo">
            <h1>Forno de Pizza</h1>
        </div>
        <nav>
            <ul class="menu-cadastro">
                <li><a href="#cadastro">Cadastro</a></li>
            </ul>
            <ul class="menu-centro">
                <li><a href="#home">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>

    <div style="margin-top: 50px"></div>

    <?php
    $sqlSabores = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");
    ?>

    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <p style="font-size: 30px"><b>Pedido</b></p>
            </div>
        </div>
    </div>


    <?php

    $contador = 4;
    $vezes = 0;

    while ($arraySabores = mysqli_fetch_array($sqlSabores)) {

        $idSabor = $arraySabores['idSabor'];

        if($contador == 4 && $vezes == 0){
    ?>
    
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-center">
        <div class="row row-cols-auto">
            <div class="col align-items-center">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <form method="POST" action="pedido.php">
                            <input type="hidden" name="idSabor" value="<?php echo $idSabor ?>">
                            <button type="subimit" class="btn btn-warning"><?php echo "R$" . $arraySabores['precoSabor'] ?></button>
                        </form>
                    </div>
                </div>
            </div>
        

    <?php
        $contador = 1;
        $vezes++;
        
    } elseif ($contador == 4 && $vezes > 0){
    ?>
        </div>
    </div>
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-center">
        <div class="row row-cols-auto">
            <div class="col align-items-center">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <form method="POST" action="pedido.php">
                            <input type="hidden" name="idSabor" value="<?php echo $idSabor ?>">
                            <button type="subimit" class="btn btn-warning"><?php echo "R$" . $arraySabores['precoSabor'] ?></button>
                        </form>
                    </div>
                </div>
            </div>
        

    <?php
        $contador = 1;
        $vezes++;

    } else {
    ?>
        <div class="col align-items-center">
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                    <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                    <form method="POST" action="pedido.php">
                        <input type="hidden" name="idSabor" value="<?php echo $idSabor ?>">
                        <button type="subimit" class="btn btn-warning"><?php echo "R$" . $arraySabores['precoSabor'] ?></button>
                    </form>
                </div>
            </div>
        </div>

<?php

    $contador++;
    $vezes++;
    }
}
?>
        </div>
    </div>


    <div class="barra-lateral">
        <div class="container text-center d-flex justify-content-center" style="font-size: 20px;">
            <p><b>Meu Carrinho</b></p>
        </div>

        <!-- Itens do carrinho aqui -->
        <div class="items-carrinho">
            <div class="container text-center d-flex justify-content-center" id="item-carrinho">
                <div class="row row-cols">
                    <div class="col align-items-center">
                        <img src="../imagens/pizza1.jpeg" class="img-thumbnail">
                    </div>
                </div>
            </div>

            <div class="container text-center d-flex justify-content-center" id="item-carrinho">
                <div class="row row-cols">
                    <div class="col align-items-center">
                        item
                    </div>
                    <div class="col align-items-center">
                        preço
                    </div>
                </div>
            </div>
            <div class="container text-center d-flex justify-content-center" id="item-carrinho">
                <div class="row row-cols">
                    <div class="col align-items-center">
                        <form action="" method="POST">
                            <input type="hidden" name="" value="">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensagem de carrinho vazio aqui -->
        <div class="container text-center d-flex justify-content-center" style="font-size: 15px;">
            <p>Carrinho vazio</p>

        </div>
    </div>



<div style="margin-top: 50px"></div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>