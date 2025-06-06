<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Painel de Pizza</title>
</head>

<body>

    <!-- Navbar fixa topo -->
    <nav class="navbar navbar-warning bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Forno de Pizza</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Forno de Pizza</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- Links do menu lateral -->
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="painel.php">Painel de Pizzas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Espaço para navbar fixa -->
    <div style="margin-top: 100px"></div>

    <!-- Container com título e formulário para adicionar pizza -->
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <p id="textogrande" style="font-size: 30px;">Adicionar Pizza</p>
            </div>
        </div>

        <!-- Formulário de envio com enctype para upload de arquivos (não usado aqui) -->
        <form class="form-floating" method="POST" action="conclusão_add_pizza.php" enctype="multipart/form-data">
            <!-- Campo para nome do sabor -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Pizza" name="nomeSabor" require>
                <label for="floatingInput">Nome do Sabor</label>
            </div>
            <!-- Campo para preço -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="30,00" name="precoSabor" maxlength="6" oninput="formatarPreco(this)" require>
                <label for="floatingInput">Preço</label>
            </div>
            <!-- Campo para descrição -->
            <div class="form-floating">
                <textarea class="form-control" placeholder="Descrição" id="floatingTextarea" name="descSabor" require></textarea>
                <label for="floatingTextarea">Descrição</label>
            </div>
            <!-- Botão enviar -->
            <button type="subimit" class="btn btn-warning">Enviar</button>
        </form>
    </div>

</body>

<!-- Scripts JS -->
<script src="../JavaScript/add_pizza.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</html>
