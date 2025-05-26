 const usuarioLogado = true; // Mude para false se quiser simular "não logado"

        if (usuarioLogado) {
            const userArea = document.getElementById("user-area");
            const cadastroLink = document.getElementById("cadastro-link");

            // Remove o link de cadastro
            if (cadastroLink) {
                cadastroLink.parentElement.remove();
            }

            // Cria o ícone de perfil
            const perfilLi = document.createElement("li");
            const perfilImg = document.createElement("img");
            perfilImg.src = "./imagens/Icone"; // Substitua pelo caminho real da imagem
            perfilImg.alt = "Perfil do usuário";
            perfilImg.className = "perfil-icon";

            perfilLi.appendChild(perfilImg);
            userArea.appendChild(perfilLi);