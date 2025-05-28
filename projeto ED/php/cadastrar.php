<?php
// Inclui a conexão com o banco de dados
include_once "../includes/conectarBD.php";

// Inclui a lógica de registro (cadastro de usuário)
include_once '../includes/registro.php';

// Inclui a lógica de login (autenticação de usuário)
include_once '../includes/login.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Define o conjunto de caracteres -->
    <meta charset="UTF-8" />
    <!-- Responsividade para dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Link para o arquivo CSS que estiliza a página -->
    <link rel="stylesheet" href="../style/cadastro.css" />
    <title>login</title>
</head>

<body>
    <!-- Container principal que engloba todo o conteúdo da página -->
    <div class="container">
    
        <!-- Primeira parte: conteúdo de boas-vindas e formulário de cadastro -->
        <div class="content first-content">
        
            <!-- Coluna esquerda: mensagem de boas-vindas e botão para trocar para login -->
            <div class="first-column">
                <h2 class="title title-primary">Bem-Vindo</h2>
                <p class="description description-primary">Por favor, insira suas credenciais para acessar sua conta.</p>
                <p class="description description-primary">Por favor, faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div>
            
            <!-- Coluna direita: formulário para criar uma nova conta -->
            <div class="second-column">
                <h2 class="title title-second">Criar a conta</h2>
                <p class="description description-secund">Use seu email para registrar</p>
                
                <!-- Formulário que envia dados para cadastrar.php via POST -->
                <form id="formCadastro" class="form" method="POST" action="cadastrar.php">
                    
                    <!-- Campo para o nome do usuário -->
                    <label class="label-input">
                        <i class="fa-solid fa-user icone-modify"></i>
                        <input type="text" name="nome" placeholder="Nome" required />
                    </label>
                    
                    <!-- Campo para o email do usuário -->
                    <label class="label-input">
                        <i class="fa-solid fa-envelope icone-modify"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </label>
                    
                    <!-- Campo para a senha do usuário -->
                    <label class="label-input">
                        <i class="fa-solid fa-lock icone-modify"></i>
                        <input type="password" name="senha" placeholder="Senha" required />
                    </label>
                    
                    <!-- Espaço para exibir mensagem de sucesso ou erro no cadastro -->
                    <div id="mensagem" style="margin-top: 10px; color: green;">
                        <?php
                        // Se a variável $mensagem estiver preenchida, exibe o conteúdo
                        if (!empty($mensagem)) {
                            echo $mensagem;
                        }
                        ?>
                    </div>
                    
                    <!-- Botão para enviar o formulário de registro -->
                    <button class="btn btn-second" type="submit">Registro</button>
                </form>
            </div>
        </div>
        
        <!-- Segunda parte: conteúdo de login -->
        <div class="content second-content">
        
            <!-- Coluna esquerda: mensagem de incentivo e botão para trocar para cadastro -->
            <div class="first-column">
                <h2 class="title title-primary">Olá, Amigo</h2>
                <p class="description description-primary">Entre na sua conta</p>
                <p class="description description-primary">Please login with your personal info</p>
                <button id="signup" class="btn btn-primary">Registro</button>
            </div>
            
            <!-- Coluna direita: formulário para login -->
            <div class="second-column">
                <h2 class="title title-second">Entre na sua conta</h2>
                
                <!-- Formulário que envia dados para cadastrar.php via POST (pode ser melhor separar login e cadastro) -->
                <form class="form" method="POST" action="cadastrar.php">
                    
                    <!-- Campo de email -->
                    <label class="label-input">
                        <i class="fa-solid fa-envelope icone-modify"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </label>
                    
                    <!-- Campo de senha -->
                    <label class="label-input">
                        <i class="fa-solid fa-lock icone-modify"></i>
                        <input type="password" name="password" placeholder="Senha" required />
                    </label>
                    
                    <!-- Espaço para exibir mensagem de erro no login -->
                    <?php if (!empty($mensagem_login)): ?>
                        <div style="color: red; margin-bottom: 10px; text-align: center;">
                            <?= $mensagem_login ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Link para recuperar senha -->
                    <a class="password" href="#">Esqueceu sua senha?</a>
                    
                    <!-- Botão para enviar o formulário de login -->
                    <button class="btn btn-second" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- Script para alternar entre as telas de login e cadastro -->
<script src="../JavaScript/script.js"></script>

<!-- Link para os ícones do FontAwesome -->
<script src="https://kit.fontawesome.com/23223f73dd.js" crossorigin="anonymous"></script>

</html>
