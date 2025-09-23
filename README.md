# Estação de Bebidas e Sabores

## 1. Entidade escolhida e justificativa

A entidade principal escolhida para o CRUD foi **Pedidos**.\
- **Por quê?** É a parte central do funcionamento do restaurante --- os
usuários podem selecionar pratos, bebidas, incluir observações e avaliar
pedidos.\
- A partir dessa entidade é possível demonstrar as operações básicas de
um CRUD: - **Create**: adicionar um pedido. - **Read**: listar pedidos
em uma tabela. - **Update**: editar um pedido existente. - **Delete**:
excluir um pedido. - (Extra) Avaliar pedido -- um campo a mais que
complementa a experiência.

Além disso, há um mini-CRUD para **Usuários** usando `localStorage`
(cadastro, login, recuperação de senha), que reforça a autenticação.

## 2. Tecnologias e linguagens utilizadas

### Frontend

-   **HTML5**: estrutura do site (nav, seções, formulários e cards).
-   **CSS3**: estilização customizada (animações fade-in, hover em
    cards, layout responsivo).
-   **Bootstrap 5**: framework CSS para componentes responsivos, navbar
    fixa, modais, tabs e botões.
-   **JavaScript (puro)**: lógica de:
    -   Animações ao rolar a página (IntersectionObserver).
    -   CRUD de pedidos (adicionar, editar, deletar, avaliar).
    -   Autenticação com `localStorage` (login, cadastro, logout,
        recuperação de senha).

### Backend

-   Não há backend real (servidor, banco de dados) --- para fins
    acadêmicos, foi usado o **`localStorage` do navegador** para simular
    persistência de dados de usuários.

## 3. Desafios encontrados e soluções

  -----------------------------------------------------------------------
  Desafio                Como foi superado
  ---------------------- ------------------------------------------------
  **Persistência sem     Utilizamos `localStorage` para simular um banco
  backend** -- não havia de dados, armazenando JSON com informações de
  servidor para salvar   cadastro e login.
  dados de usuários.     

  **Validação de login e Adicionamos uma checagem antes de salvar um novo
  cadastro** -- evitar   usuário no `localStorage`.
  que e-mails duplicados 
  fossem cadastrados.    

  **Edição e exclusão de Implementamos eventos "click" nos botões
  pedidos** -- ao        "Editar" e "Excluir", removendo a linha da
  editar, o pedido       tabela e repondo os dados no formulário.
  antigo precisava sair  
  da lista.              

  **Animações ao rolar a Foi usado `IntersectionObserver` para adicionar
  página** -- garantir   a classe `.appear` dinamicamente.
  que os elementos só    
  aparecessem após       
  entrar no viewport.    

  **Imagens não          Substituímos por URLs de imagens livres
  carregavam ou eram     (Unsplash e Pexels) adequadas a cada promoção.
  pouco realistas** --   
  links quebrados ou     
  genéricos.             
  -----------------------------------------------------------------------

## 4. Estrutura geral do código

-   **HTML**: Navbar, Hero, Menu, Promoções, Pedidos (CRUD), Sobre,
    Contato, Modais de login/cadastro/recuperação/avaliação.
-   **CSS**: Animações e estilos personalizados.
-   **JS**: Toda a lógica de interação (CRUD de pedidos, autenticação,
    animações).

> 📌 **Resumo:** O projeto demonstra um CRUD funcional de pedidos e um
> mini-CRUD de usuários com autenticação. Usa tecnologias simples do
> lado do cliente para simular um sistema completo de restaurante sem
> precisar de backend real.
