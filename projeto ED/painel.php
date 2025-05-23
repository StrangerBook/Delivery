<?php

require_once("includes/conectarBD.php");

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

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Offcanvas dark navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
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
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

<?php
// teste pra ver se o banco de dados ta dando certo

/*
$nome = "pizza doida";
$desc = "roblox mineiro";
$preco = "2.32";

    $sql = mysqli_query($conexao, "INSERT INTO saborpizpainel (nomeSabor, descSabor, precoSabor) VALUES ('$nome', '$desc', '$preco')") or die("Erro no 
comando SQL!!!" . mysqli_error($conexao));

*/
    ?>

    <?php

    $sqlSabores = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");

    ?>

    <?php
    while ($arraySabores = mysqli_fetch_array($sqlSabores)) {
    ?>

    <div class="container text-center">
            <div class="row align-items-start">
                <div class="col">
                    <?php echo $arraySabores['idSabor']; ?>
                </div>
                <div class="col">
                    <?php echo $arraySabores['nomeSabor']; ?>
                </div>
                <div class="col">
                    <?php echo $arraySabores['descSabor']; ?>
                </div>
                <div class="col">
                    <?php echo $arraySabores['precoSabor']; ?>
                </div>
            </div>
        </div>
<?php
/*
        <tr>
            <td width="10%" height="25"><b>
                    <font face="Arial" size="2"><?php echo $arraySabores['idSabor']; ?></font>
            </td>
            <td width="20%" height="25"><b>
                    <font face="Arial" size="2"><?php echo $arraySabores['nomeSabor']; ?></font>
            </td>
            <td width="10%" height="25"><b>
                    <font face="Arial" size="2"><?php echo $arraySabores['descSabor']; ?></font>
            </td>
            <td width="10%" height="25"><b>
                    <font face="Arial" size="2"><?php echo $arraySabores['precoSabor']; ?></font>
            </td>
        </tr>
*/
?>

    <?php
    }
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>