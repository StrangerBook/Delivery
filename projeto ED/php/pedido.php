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
        <nav class="navbar navbar-expand-lg" style="background-color: #6E2C00;">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="pedido.php">Pedido</a>
                        </li>

                        <!-- Dropdown com cadastro/login -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Conta
                            </a>
                            <ul class="dropdown-menu text-center">
                                <?php if (isset($_SESSION['usuario_nome'])): ?>
                                    <li class="dropdown-item-text">
                                        Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong>
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="../php/cadastrar.php">Cadastro</a></li>
                                    <li><a class="dropdown-item" href="../php/login.php">Login</a></li>
                                <?php endif; ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div style="margin-top: 50px"></div>

    <?php
    $sqlSabores = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");
    
    if(isset($POST['add'])){

        $idSaborAdd = $POST['idSaborAdd'];
        $totalPedido = 0;

        
        
        
        $sqlQtd = mysqli_query($conexao, "INSERT INTO quantidadepiz (id_sabor) VALUES ('$idSaborAdd')") or die("Erro no
    comando SQL!!!<br/>" . mysqli_error($conexao));
    echo "";

        

        $sqlSabores2 = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");
    

        $sqlPedido = mysqli_query($conexao, "INSERT INTO pedido (totalPedido, idQuant) VALUES ('$totalPedido', '$idQuant')") or die("Erro no
    comando SQL!!!<br/>" . mysqli_error($conexao));
    echo "";

    }
    
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
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <form method="POST" action="pedido.php">
                            <input type="hidden" name="idSaborAdd" value="<?php echo $idSabor ?>">
                            <input type="hidden" name="add" value="S">
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
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <form method="POST" action="pedido.php">
                            <input type="hidden" name="idSaborAdd" value="S">
                            <input type="hidden" name="add" value="<?php echo $idSabor ?>">
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
                <div class="card-body">
                    <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                    <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                    <form method="POST" action="pedido.php">
                        <input type="hidden" name="idSaborAdd" value="<?php echo $idSabor ?>">
                        <input type="hidden" name="add" value="S">
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
<div class="container text-center d-flex justify-content-center">
    <form action="../checkout.html">
      <button type="subimit" class="btn btn-warning">Continuar</button>
      </form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>