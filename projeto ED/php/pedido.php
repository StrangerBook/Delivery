<?php

require_once("../includes/conectarBD.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
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
                        <a href="#" class="btn btn-primary"><?php echo "R$" . $arraySabores['precoSabor'] ?></a>
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
                        <a href="#" class="btn btn-primary"><?php echo "R$" . $arraySabores['precoSabor'] ?></a>
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
                    <a href="#" class="btn btn-primary"><?php echo "R$" . $arraySabores['precoSabor'] ?></a>
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
<div style="margin-top: 50px"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>