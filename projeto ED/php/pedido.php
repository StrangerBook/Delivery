<?php
// Inclui o arquivo de conexão com o banco de dados
require_once("../includes/conectarBD.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Configurações do cabeçalho da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Importa o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">

    <!-- Importa o CSS personalizado -->
    <link rel="stylesheet" href="../style/estilo.css">

    <!-- Título da aba -->
    <title>Document</title>
</head>

<body>
    <!-- Início do cabeçalho da página -->
    <header>

        <!-- Título do sistema -->
        <div class="logo">
            <h1>Forno de Pizza</h1>
        </div>

        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-lg" style="background-color: #6E2C00;">
            <div class="container-fluid">

                <!-- Botão de toggle para dispositivos móveis -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Itens do menu -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <!-- Link para a página inicial -->
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="index.php">Início</a>
                        </li>

                        <!-- Link para página de pedido -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="pedido.php">Pedido</a>
                        </li>

                        <!-- Dropdown com opções de conta -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Conta
                            </a>
                            <ul class="dropdown-menu text-center">
                                <!-- Verifica se o usuário está logado -->
                                <?php if (isset($_SESSION['usuario_nome'])): ?>
                                    <!-- Saudação ao usuário -->
                                    <li class="dropdown-item-text">
                                        Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong>
                                    </li>
                                    <!-- Opção para sair -->
                                    <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                                <?php else: ?>
                                    <!-- Link para cadastro -->
                                    <li><a class="dropdown-item" href="../php/cadastrar.php">Cadastro</a></li>
                                    <!-- Link para login -->
                                    <li><a class="dropdown-item" href="../php/login.php">Login</a></li>
                                <?php endif; ?>
                                <!-- Linha divisória -->
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

    <!-- Espaçamento superior -->
    <div style="margin-top: 50px"></div>

    <?php
    // Consulta sabores da tabela
    $sqlSabores = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");

    // Verifica se o formulário de adicionar sabor foi enviado
    if (isset($POST['add'])) {

        // Armazena o ID do sabor a ser adicionado
        $idSaborAdd = $POST['idSaborAdd'];
        $totalPedido = 0;

        // Insere na tabela quantidadepiz
        $sqlQtd = mysqli_query($conexao, "INSERT INTO quantidadepiz (id_sabor) VALUES ('$idSaborAdd')") or die("Erro no comando SQL!!!<br/>" . mysqli_error($conexao));
        echo "";

        // Reconsulta os sabores
        $sqlSabores2 = mysqli_query($conexao, "SELECT idSabor, nomeSabor, descSabor, precoSabor FROM saborpizpainel ORDER BY idSabor") or die("Não foi possível realizar a consulta.");

        // Insere na tabela de pedidos
        $sqlPedido = mysqli_query($conexao, "INSERT INTO pedido (totalPedido, idQuant) VALUES ('$totalPedido', '$idQuant')") or die("Erro no comando SQL!!!<br/>" . mysqli_error($conexao));
        echo "";
    }
    ?>

    <!-- Título da seção de pedidos -->
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <p style="font-size: 30px"><b>Pedido</b></p>
            </div>
        </div>
    </div>

    <?php
    // Contadores auxiliares para layout
    $contador = 4;
    $vezes = 0;

    // Loop pelos sabores
    while ($arraySabores = mysqli_fetch_array($sqlSabores)) {

        // Armazena o ID do sabor atual
        $idSabor = $arraySabores['idSabor'];

        // Primeira linha de cards
        if ($contador == 4 && $vezes == 0) {
    ?>

            <!-- Layout da primeira linha -->
            <div style="margin-top: 50px"></div>
            <div class="container text-center d-flex justify-content-center">
                <div class="row row-cols-auto">
                    <div class="col align-items-center">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <!-- Nome do sabor -->
                                <h5 class="card-title"><?php echo $arraySabores['nomeSabor'] ?></h5>
                                <!-- Descrição do sabor -->
                                <p class="card-text"><?php echo $arraySabores['descSabor'] ?></p>
                                <!-- Formulário para adicionar sabor ao pedido -->
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
            } elseif ($contador == 4 && $vezes > 0) {
                ?>
                    <!-- Fim da linha anterior e início de nova linha -->
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
                    <!-- Adiciona novo card à linha atual -->
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
                // Incrementa contadores
                $contador++;
                $vezes++;
            }
        }
            ?>
                </div>
            </div>

            <!-- Espaçamento inferior -->
            <div style="margin-top: 50px"></div>

</body>
<!-- Importa script do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
</html>