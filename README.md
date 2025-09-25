Estação de Bebidas e Sabores - Website
Este é um projeto de uma página web única (single-page) para um restaurante fictício chamado "Estação de Bebidas e Sabores". O site é totalmente responsivo e foi construído com HTML, Bootstrap 5 e JavaScript puro, apresentando seções de menu, promoções e um sistema interativo de pedidos e autenticação de usuários.

✨ Funcionalidades Principais
Design Responsivo: O layout se adapta perfeitamente a diferentes tamanhos de tela, de desktops a dispositivos móveis, graças ao uso do framework Bootstrap.

Navegação Fixa e Suave: Uma barra de navegação no topo da página permite o acesso rápido a todas as seções, com um efeito de rolagem suave.

Animações de Rolagem: Elementos surgem suavemente na tela à medida que o usuário rola a página, utilizando a API IntersectionObserver do JavaScript para um efeito moderno.

Sistema de Pedidos Interativo:

Adicionar Pedidos: Um formulário permite que os usuários selecionem pratos e bebidas e os adicionem a uma tabela de "Meus Pedidos".

Editar e Excluir: Cada pedido na lista pode ser editado (recarregando os dados no formulário) ou excluído dinamicamente.

Avaliar Pedidos: Uma funcionalidade de avaliação em um modal permite ao usuário dar uma nota de 1 a 5 estrelas para cada pedido feito.

Sistema de Autenticação Completo:

Cadastro e Login: Os usuários podem se cadastrar e fazer login. As informações são salvas no localStorage do navegador, mantendo o usuário conectado mesmo após fechar a página.

Recuperação de Senha: Um modal simulado para "Esqueceu a senha?" foi implementado.

Área de Usuário Dinâmica: A barra de navegação exibe o nome do usuário logado e um botão de "Sair", ou o botão "Login / Cadastro" caso contrário.

🛠 Tecnologias Utilizadas
HTML5: Para a estrutura semântica do conteúdo da página.

CSS3: Estilos personalizados para animações e efeitos de hover nos cards.

Bootstrap 5.1.3: Framework CSS para criar um layout responsivo e utilizar componentes pré-estilizados como a barra de navegação, modais, cards e o sistema de grid.

JavaScript (ES6+): Para toda a interatividade da página, incluindo:

Manipulação do DOM para o sistema de pedidos.

Gerenciamento de eventos (event listeners).

Uso da API IntersectionObserver para animações de scroll.

Gerenciamento de dados no localStorage para o sistema de autenticação.

🚀 Como Executar
Este projeto não requer um servidor web ou dependências complexas. Para executá-lo:

Salve o código como um arquivo index.html.

Abra o arquivo index.html em qualquer navegador de internet moderno (como Chrome, Firefox, ou Edge).

Pronto! A página será carregada e todas as funcionalidades estarão disponíveis.

🏛 Estrutura do Código
O código está contido em um único arquivo HTML, organizado da seguinte forma:

<head>: Inclui metadados, o título da página e a importação dos arquivos CSS e JS do Bootstrap via CDN. A seção <style> contém o CSS personalizado.

<body>:

<nav>: A barra de navegação superior, que é fixa.

<div id="home">: Seção principal (Hero) com a imagem de fundo e o título.

<section>: O corpo da página é dividido em seções temáticas:

#menu: Exibe os pratos disponíveis.

#promocoes: Mostra as promoções especiais.

#pedidos: Contém o formulário para fazer pedidos e a tabela que os exibe.

#sobre: Informações sobre o restaurante.

#contato: Dados para contato e localização.

Modais: O código HTML para os modals (janelas pop-up) de autenticação, recuperação de senha e avaliação de pedidos está no final do <body>.

<script>:

Todo o código JavaScript está localizado no final do <body>.

Lógica de Animação: Configura o IntersectionObserver para aplicar classes de animação aos elementos quando eles se tornam visíveis.

Lógica de Pedidos: Gerencia os eventos do formulário de pedidos, adicionando, editando, excluindo e avaliando itens na tabela.

Lógica de Autenticação: Controla os formulários de login, cadastro e recuperação de senha, utilizando o localStorage para armazenar e recuperar dados dos usuários e o estado de login.