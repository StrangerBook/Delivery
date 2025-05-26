<?php
include_once "../includes/conectarBD.php";
include_once '../includes/registro.php';
include_once '../includes/login.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../style/cadastro.css" />
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem-Vindo</h2>
                <p class="description description-primary">Por favor, insira suas credenciais para acessar sua conta.</p>
                <p class="description description-primary">Por favor, faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Criar a conta</h2>
                <p class="description description-secund">Use seu email para registrar</p>
                <form id="formCadastro" class="form" method="POST" action="cadastrar.php">
                    <label class="label-input">
                        <i class="fa-solid fa-user icone-modify"></i>
                        <input type="text" name="nome" placeholder="Nome" required />
                    </label>
                    <label class="label-input">
                        <i class="fa-solid fa-envelope icone-modify"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </label>
                    <label class="label-input">
                        <i class="fa-solid fa-lock icone-modify"></i>
                        <input type="password" name="senha" placeholder="Senha" required />
                    </label>
                    <div id="mensagem" style="margin-top: 10px; color: green;">
                        <?php
                        if (!empty($mensagem)) {
                            echo $mensagem;
                        }
                        ?>
                    </div>
                    <button class="btn btn-second" type="submit">Registro</button>
                </form>
            </div>
        </div>
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, Amigo</h2>
                <p class="description description-primary">Entre na sua conta</p>
                <p class="description description-primary">Please login with your personal info</p>
                <button id="signup" class="btn btn-primary">Registro</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Entre na sua conta</h2>
                <form class="form" method="POST" action="cadastrar.php">
                    <label class="label-input">
                        <i class="fa-solid fa-envelope icone-modify"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </label>
                    <label class="label-input">
                        <i class="fa-solid fa-lock icone-modify"></i>
                        <input type="password" name="password" placeholder="Senha" required />
                    </label>
                    <?php if (!empty($mensagem_login)): ?>
                        <div style="color: red; margin-bottom: 10px; text-align: center;">
                            <?= $mensagem_login ?>
                        </div>
                    <?php endif; ?>
                    <a class="password" href="#">Esqueceu sua senha?</a>
                    <button class="btn btn-second" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../JavaScript/script.js"></script>
<script src="https://kit.fontawesome.com/23223f73dd.js" crossorigin="anonymous"></script>

</html>