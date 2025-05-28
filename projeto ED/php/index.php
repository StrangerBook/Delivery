<?php
// Inclui arquivos de conexão com o banco de dados
include_once("../includes/conectarBD.php");
include_once("../includes/conectarBDMysqli.php");

// Inicia a sessão
session_start();

// Verifica se o formulário foi enviado e se o usuário está logado
if (isset($_POST['enviar_comentario']) && isset($_SESSION['usuario_id'])) {
    // Remove espaços extras da mensagem
    $mensagem = trim($_POST['mensagem']);
    // Pega o ID e o nome do usuário da sessão
    $usuario_id = $_SESSION['usuario_id'];
    $nome = $_SESSION['usuario_nome'];

    // Verifica se a mensagem não está vazia
    if (!empty($mensagem)) {
        // Prepara o comando SQL para inserir o comentário
        $stmt = $mysqli->prepare("INSERT INTO comentarios (usuario_id, nome, mensagem) VALUES (?, ?, ?)");
        // Associa os parâmetros à query
        $stmt->bind_param("iss", $usuario_id, $nome, $mensagem);
        // Executa a inserção
        $stmt->execute();
        // Fecha a query
        $stmt->close();
    }
}
?>



<!-- Declaração do tipo de documento e idioma -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadados da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Importação do Bootstrap e CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">

    <!-- Título da aba do navegador -->
    <title>Forno da Pizza</title>
</head>

<body>
    <!-- Cabeçalho com logo e menu de navegação -->
    <header>
        <div class="logo">
            <h1>Forno de Pizza</h1>
        </div>
        <nav class="navbar navbar-expand-lg" style="background-color: #6E2C00;">
            <div class="container-fluid">
                <!-- Botão de menu para telas pequenas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Itens do menu -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="#">Início</a>
                        </li>
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

    <!-- Seção do banner principal -->
    <section id="home" class="banner">
        <div class="banner-text">
            <h2>Bem-vindo ao Forno de Pizza</h2>
            <p>A melhor Pizza da região, feito com paixão!</p>
            <a href="#menu" class="btn">Ver Menu</a>
        </div>
    </section>

    <!-- Seção com as pizzas em destaque -->
    <section id="menu" class="menu">
        <h2>Especialidades da Casa</h2>
        <div class="menu-grid">
            <div class="menu-item">
                <img src="../imagens/pizza1.jpeg" alt="Mariô da Casa">
                <h3>Mariô da Casa</h3>
                <p>R$ 59,90</p>
            </div>
            <div class="menu-item">
                <img src="../imagens/pizza2.jpg" alt="Churrascão do Zé">
                <h3>Churrascão do Zé</h3>
                <p>R$ 54,90</p>
            </div>
            <div class="menu-item">
                <img src="../imagens/pizza3.jpg" alt="Goiabêxa">
                <h3>Goiabêxa</h3>
                <p>R$ 48,90</p>
            </div>
        </div>
    </section>

    <!-- Seção sobre a empresa -->
    <section id="sobre" class="sobre">
        <h2>Sobre Nós</h2>
        <p>O Forno da Pizza nasceu da paixão por pizzas especiais e momentos memoráveis. Desde 2010, servimos qualidade
            e sabor único.</p>
    </section>

    <!-- Seção de comentários -->
    <section id="contato" class="contato">
        <h2>Comentarios</h2>
        <form method="POST" action="">
            <input type="text" name="mensagem" placeholder="Digite seu Comentario" required>
            <?php if (!isset($_SESSION['usuario_id'])): ?>
                <p style="color: red; margin: 10px 0;">⚠️ É obrigatório estar logado para comentar.</p>
            <?php endif; ?>
            <button type="submit" name="enviar_comentario"
                <?php echo !isset($_SESSION['usuario_id']) ? 'disabled' : ''; ?>>
                Enviar
            </button>
        </form>

        <!-- Exibição dos comentários já feitos -->
        <div class="comentarios-lista">
            <?php
            $resultado = $mysqli->query("SELECT nome, mensagem, data_comentario FROM comentarios ORDER BY data_comentario DESC");
            while ($comentario = $resultado->fetch_assoc()) {
                echo "<div class='comentario'>";
                echo "<strong>" . htmlspecialchars($comentario['nome']) . "</strong><br>";
                echo "<p>" . nl2br(htmlspecialchars($comentario['mensagem'])) . "</p>";
                echo "<small>" . date("d/m/Y H:i", strtotime($comentario['data_comentario'])) . "</small>";
                echo "<hr>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <!-- Rodapé com redes sociais -->
    <footer>
        <div class="redes-sociais">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
        <p>&copy; 2025 Forno da Pizza. Todos os direitos reservados.</p>
    </footer>
</body>

<!-- Importação do JavaScript do Bootstrap -->
<script src="../JavaScript/bootstrap.bundle.min.js"></script>

</html>
