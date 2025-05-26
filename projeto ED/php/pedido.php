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
    <title>Pedido</title>
</head>

<body>

    <header>
        <div class="logo">
            <h1>Forno de Pizza</h1>
        </div>
        <nav>
            <ul class="menu-cadastro" style="display: flex; gap: 10px; align-items: center;">
                <li>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>0</a>
                </li>
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                    <li style="list-style: none; color: white;">
                        <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                    </li>
                    <li style="list-style: none;">
                        <a href="logout.php" style="color: white; text-decoration: none; background-color: #a00; padding: 5px 10px; border-radius: 5px;">Sair</a>
                    </li>
                <?php else: ?>
                    <li><a href="../php/cadastrar.php">Cadastro</a></li>
                <?php endif; ?>
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

    $contador = 3;
    $vezes = 0;

    while ($arraySabores = mysqli_fetch_array($sqlSabores)) {

        $idSabor = $arraySabores['idSabor'];

        if($contador == 3 && $vezes == 0){
    ?>
    
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-start">
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
        
    } elseif ($contador == 3 && $vezes > 0){
    ?>
        </div>
    </div>
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-start">
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
<div style="margin-top: 50px"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>