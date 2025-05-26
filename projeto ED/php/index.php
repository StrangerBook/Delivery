<?php
include_once("../includes/conectarBD.php");
include_once("../includes/conectarBDMysqli.php");
session_start();

if (isset($_POST['enviar_comentario']) && isset($_SESSION['usuario_id'])) {
    $mensagem = trim($_POST['mensagem']);
    $usuario_id = $_SESSION['usuario_id'];
    $nome = $_SESSION['usuario_nome'];

    if (!empty($mensagem)) {
        $stmt = $mysqli->prepare("INSERT INTO comentarios (usuario_id, nome, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $usuario_id, $nome, $mensagem);
        $stmt->execute();
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">
    <title>Forno da Pizza</title>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Forno de Pizza</h1>
        </div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
          <ul class="dropdown-menu">
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
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
        <nav>
            <ul class="menu-cadastro" style="display: flex; gap: 10px; align-items: center;">
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
                <li><a href="../php/pedido.php">Menu</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>
    <section id="home" class="banner">
        <div class="banner-text">
            <h2>Bem-vindo ao Forno de Pizza</h2>
            <p>A melhor Pizza da região, feito com paixão!</p>
            <a href="#menu" class="btn">Ver Menu</a>
        </div>
    </section>


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


    <section id="sobre" class="sobre">
        <h2>Sobre Nós</h2>
        <p>O Forno da Pizza nasceu da paixão por pizzas especiais e momentos memoráveis. Desde 2010, servimos qualidade
            e sabor único.</p>
    </section>
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
    <footer>
        <div class="redes-sociais">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
        <p>&copy; 2025 Forno da Pizza. Todos os direitos reservados.</p>
    </footer>
</body>

</html>