# Delivery
Feito pro trabalho de Estrutura de Dados.

- Descrição do projeto

Este projeto é um sistema web completo para gerenciamento de uma pizzaria, desenvolvido com foco em praticidade e experiência do usuário. A aplicação foi construída utilizando PHP, HTML, CSS, JavaScript e MySQL, permitindo tanto o cadastro e exibição de pizzas quanto funcionalidades administrativas e interativas.
Funcionalidades principais:
Cadastro de novas pizzas com nome, descrição, preço, etc.
Listagem dinâmica das pizzas cadastradas no banco de dados.
Edição e exclusão de pizzas diretamente da interface administrativa.
Interface amigável e responsiva, adaptada para dispositivos móveis.
Validação de dados no front-end e no back-end para maior segurança.

- Instruções de execução

Primeiramente precisa do aplicativo Xampp instalado no seu computador, abra o "Xampp Control Panel" e clique nos botões "Start" que estão na frente do nome "Apache" e "MySQL" e depois no botão "Admin" que está na frente do MySQL, após abrir no seu navegador o
MySQL, clique, na coluna mais a esquerda, no nome "Novo", e na segunda linha mais acima da pagina clique no botão "Importar", ele vai pedir um arquivo, use o arquivo "pizzaria.sql" que irá criar o banco de dados usado no codigo. Após isso, volte ao Xampp Control
Panel e clique no botão "Explorer", na pasta que abrir abra a pasta htdocs, pegue o arquivo do Delivery e passe para a pasta htdocs. Agora abra a pasta da Delivery, abra a pasta "projeto ED", abra a pasta "php" e abra o arquivo "painel.php" no seu "VSCode", após
isso, vá na barra lateral do VSCode onde visualiza as extenções ("Extensions") e instale a extenção "Open PHP/HTML/JS In Browser", após isso volte ao codigo do painel.php, clique com o botão direito do seu mouse no código e clique na opção "Open PHP/HTML/JS In
Browser", selecione o seu navegador de preferência na barra mais acima do VSCode. Com o painel.php aberto, haverá pizzas já preparadas dentro do banco de dados. Nessa parte do painel é possivel ver todos os sabores de pizzas salvas no banco de dados e excluir-
los clicando no botão "excluir" em qualquer pizza que você desejar. Clicando nos três traços no topo da tela é possivel acessar o painel de adicionar sabores onde você pode ecolher o nome do sabor, o preço (que coloca a virgula automaticamente) e descrição da 
pizza. Ao clicar enviar, é possivel ver os dados cadastrados e voltar ao painel principal, ainda antes de inserir um sabor é possivel voltar para o painel pelos três traços em cima do site. Ao voltar para o painel é possivel também escolher um sabor para alterar
os dados contidos nela clicando em alterar na pizza que você queiser, que te mandara para um site que mostrará as informações já contidas do sabor e você poderá altera-las do mesmo modo que é mostrado na criação.
Abrindo o index.php você pode ver um exemplo de pizzas mais pedidas, comentarios de usuarios anteriores e o sobre da pizzaria. Na barra de cima você pode se cadastrar ou fazer login com algumas confirmações de email, tudo sendo salvo no banco de dados, após o 
login você pode fazer comentarios no index que ficam salvos e exibidos no próprio index. Clicando em Pedido você é redirecionado para a parte de pedido que mostra todos os sabores colocados, dessa parte para frente apenas são feitos alguns "place holders" para 
futuras atualizações do site: do pedido somos levados pro "checkout" onde se escolhe a forma de pagamento, se escolher dinheiro fisico, é mandado para a finalização, se escolher cartão, é mandado para a introdução do cartão e depois para a finalização, e daí poderá voltar ao index.

- Tecnologias utilizadas

GitHub Desktop
VScode
Xampp
HTML
CSS
PHP
JavaScript
MySQL
Bootstrap
Font Awesome

- Estrutura dos arquivos

O sistema da pizzaria foi desenvolvido com uma arquitetura web simples, utilizando as seguintes camadas:
Front-end construído com HTML, CSS e um pouco de JavaScript para a interface do usuário permitindo que ele visualize os sabores, valores e o que vem no sabor das pizzas. A interface permite que a gerência do estabelecimento cadastre mais pizzas a plataforma. Back-end desenvolvido em PHP, responsável pelo processamento das requisições, envio dos dados ao banco de dados e recuperação das informações cadastradas.Banco de Dados: implementado com MySQL. A base de dados armazena informações das pizzas, como nome, descrição, preço e o nome da imagem.
Upload de imagens: o sistema permite que o administrador envie uma imagem da pizza. Essa imagem é armazenada em uma pasta no servidor, e o nome do arquivo é salvo no banco de dados.
Modularização: o código foi separado em arquivos distintos para organização, como conexao.php, cadastro_pizza.php, listar_pizzas.php e upload.php.


- Integrantes do grupo
Carlos Eduardo, 
Felipe Martins,
João Rikelme,
Yan Magalhães
