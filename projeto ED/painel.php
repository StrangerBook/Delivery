<?php

require_once("includes/conectarBD.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Painel de Pizza</title>
</head>

<body>
    
<!--navbar com offcanvas do bootstrap com o tema da pizzaria-->

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
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <!--Colocar pagina de add pizza -->
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

<!--coloca todas as informações da tabela do banco de dados dentro de uma variavel do php -->

    <?php
    $sqlSabores = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");
    ?>

<!--Espaçamento para a navbar não ficar em cima da tabela -->
    <div style="margin-top: 100px"></div>

<?php
//usei para entender o que tava acontecendo com as variaveis
/*
    var_dump($_POST['idSaborExc']);
    var_dump($_POST['deletar']);
*/
?>
<!--Cria a primeira fileira da tabela -->
    <div class="container text-center">
            <div class="row align-items-start">
                <div class="col">
                    <p style="font-size: 20px"><b>ID</b></p>
                </div>
                <div class="col">
                    <p style="font-size: 20px"><b>Nome</b></p>
                </div>
                <div class="col">
                    <p style="font-size: 20px"><b>Ingrediente</b></p>
                </div>
                <div class="col">
                    <p style="font-size: 20px"><b>Preço</b></p>
                </div>
            </div>
        </div>

<!--pega um valor da variavel "$sqlSabores" por repetição do laço e coloca no $arraySabores -->
<?php
while ($arraySabores = mysqli_fetch_array($sqlSabores)) {

//transfere o valor do id da array pra uma variavel separada
$idSabor = $arraySabores['idSabor'];

//confere se foi requistado a exclusão de algumaa pizza, confere qual pizza e depois exclui a bendita pizza
    if(isset($_POST['deletar'])){
        if($idSabor == $_POST['idSaborExc']){
            $deleta = mysqli_query($conexao, "DELETE FROM saborpizpainel WHERE idSabor = '$idSabor'");
        }
    }

//confere se a pizza não foi selecionada para exclusão(sem isso a pizza é escrita do mesmo jeito, só sumindo se a gente recarregar a pagina [não sei ainda exatamente pq contece KKKKKKKKKK])
    if($idSabor != $_POST['idSaborExc']){
    ?>

    <!--Mostra a tabela em si, com os dados de cada loop do "while" -->
    <div class="container text-center">
            <div class="row align-items-start">
                <div class="col border border-warning" style="margin-top: 10px">
                    <?php echo $arraySabores['idSabor']; ?>
                </div>
                <div class="col border border-warning" style="margin-top: 10px">
                    <?php echo $arraySabores['nomeSabor']; ?>
                </div>
                <div class="col border border-warning" style="margin-top: 10px">
                    <?php echo $arraySabores['descSabor']; ?>
                </div>
                <div class="col border border-warning" style="margin-top: 10px">
                    <?php echo $arraySabores['precoSabor']; ?>
                </div>
            </div>
    
            <div class="row align-items-start">
                <div class="col border border-warning" style="margin-bottom: 10px">
                    
                <!--BOTÃO IMPORTANTE é usado pra excluir o item e redirecioina o usuario de volta para a propria pagina -->
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="idSaborExc" value="<?php echo $idSabor; ?>">
                        <input type="hidden" name="deletar" value="S">
                        <button type="submit" class="btn btn-danger" for="">Excluir Item</button>
                    </form>
                </div>

                <!--WIP -->
                <div class="col border border-warning" style="margin-bottom: 10px">
                    <input type="hidden" name="enviar" value="<?php echo $idSabor; ?>">
                    <button type="submit" class="btn btn-warning" for="">Alterar Item</button>
                </div>
            </div>
        </div>

<?php
    }
}
?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>