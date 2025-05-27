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
    
<!--navbar com offcanvas do bootstrap com o tema da pizzaria-->

    <nav class="navbar navbar-warning bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" >Forno de Pizza</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Forno de Pizza</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_pizza.php">Adicionar Pizza</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

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
                    <p style="font-size: 20px"><b>Pizzas</b></p>
                </div>
            </div>
        </div>

<!--pega um valor da variavel "$sqlSabores" por repetição do laço e coloca no $arraySabores -->
<?php

$contador = 4;
$vezes = 0;

while ($arraySabores = mysqli_fetch_array($sqlSabores)) {

//transfere o valor do id da array pra uma variavel separada
$idSabor = $arraySabores['idSabor'];

//confere se foi requistado a exclusão de algumaa pizza, confere qual pizza e depois exclui a bendita pizza
    if(isset($_POST['deletar'])){
        if($idSabor == $_POST['idSaborExc']){
            $deleta = mysqli_query($conexao, "DELETE FROM saborpizpainel WHERE idSabor = '$idSabor'");
        }
    }

//também confere se foi requistado alguma exclusão,
    if(isset($_POST['idSaborExc'])){  // se sim, a variavel $idSaborExc recebe o valor do item que n pode ser escrito,
        $idSaborExc = $_POST['idSaborExc'];
    } else{ //se nao, recebe 0 para mostrar todos os itens
        $idSaborExc = 0;
    }

//confere se a pizza não foi selecionada para exclusão(sem isso a pizza é escrita do mesmo jeito, só sumindo se a gente recarregar a pagina [não sei ainda exatamente pq contece KKKKKKKKKK])
    if($idSabor != $idSaborExc){

// confere em que posição das fileiras o sabor tá e quantas vezes foi passado o while (só roda se for a primeira repetição)
    if($contador == 4 && $vezes == 0){

    ?>

    <!--Mostra o primeiro card de todos, com os dados de cada loop do "while" -->
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-center">
        <div class="row align-items-start">
            <div class="col" style="margin-top: 10px">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['idSabor'] ?></p>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <p class="card-text"><?php echo "R$" . $arraySabores['precoSabor'] ?></p>

                        <!--BOTÃO IMPORTANTE é usado pra excluir o item e redirecioina o usuario de volta para a propria pagina -->
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="idSaborExc" value="<?php echo $idSabor; ?>">
                            <input type="hidden" name="deletar" value="S">
                        <button type="submit" class="btn btn-danger" for="">Excluir Item</button>
                        </form>
                        
                        <!--leva para a pagina alterar -->
                        <form method="POST" action="alterar_pizza.php">
                            <input type="hidden" name="idSabor" value="<?php echo $idSabor; ?>">
                            <button type="submit" class="btn btn-warning" for="">Alterar Item</button>
                        </form>

                    </div>
                    </div>
                </div>
            
<?php

//volta o contador pro inicio da fila
$contador = 1;
$vezes++;

// confere em que posição das fileiras o sabor tá e quantas vezes foi passado o while (roda toda vez que não for a primeira repetição)
} elseif ($contador == 4 && $vezes > 0){
?>
        </div>
    </div>
    <!--Mostra o primeiro card de cada fileira, com os dados de cada loop do "while" -->
    <div style="margin-top: 50px"></div>
    <div class="container text-center d-flex justify-content-center">
        <div class="row align-items-start">
            <div class="col" style="margin-top: 10px">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['idSabor'] ?></p>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <p class="card-text"><?php echo "R$" .  $arraySabores['precoSabor'] ?></p>

                        <!--BOTÃO IMPORTANTE é usado pra excluir o item e redirecioina o usuario de volta para a propria pagina -->
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="idSaborExc" value="<?php echo $idSabor; ?>">
                            <input type="hidden" name="deletar" value="S">
                        <button type="submit" class="btn btn-danger" for="">Excluir Item</button>
                        </form>
                        
                        <!--leva para a pagina alterar -->
                        <form method="POST" action="alterar_pizza.php">
                            <input type="hidden" name="idSabor" value="<?php echo $idSabor; ?>">
                            <button type="submit" class="btn btn-warning" for="">Alterar Item</button>
                        </form>

                    </div>
                    </div>
                </div>
<?php

//volta o contador pro inicio da fila
$contador = 1;
$vezes++;

} else {
?>

<!--Mostra um card de cada item, com os dados de cada loop do "while" -->
            <div class="col" style="margin-top: 10px">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                        <p class="card-text"><?php echo $arraySabores['idSabor'] ?></p>
                        <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                        <p class="card-text"><?php echo "R$" .  $arraySabores['precoSabor'] ?></p>

                        <!--BOTÃO IMPORTANTE é usado pra excluir o item e redirecioina o usuario de volta para a propria pagina -->
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="idSaborExc" value="<?php echo $idSabor; ?>">
                            <input type="hidden" name="deletar" value="S">
                        <button type="submit" class="btn btn-danger" for="">Excluir Item</button>
                        </form>
                        
                        <!--leva para a pagina alterar -->
                        <form method="POST" action="alterar_pizza.php">
                            <input type="hidden" name="idSabor" value="<?php echo $idSabor; ?>">
                            <button type="submit" class="btn btn-warning" for="">Alterar Item</button>
                        </form>

                    </div>
                    </div>
                </div>
<?php
//vai passando coluna por coluna
        $contador++;
        $vezes++;

        }
    }
}
?>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>