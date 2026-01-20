# LP On Feet 👟

Landing page dinâmica para uma loja de streetwear, desenvolvida com foco em design responsivo e gestão de conteúdo via painel administrativo.

## 📋 Sobre o Projeto

O **LP On Feet** é uma aplicação web que simula um e-commerce de moda urbana. O projeto foi evoluído de uma página estática HTML para uma aplicação dinâmica em PHP.
O sistema permite que o administrador gerencie o catálogo de produtos (ténis e roupas) através de um painel de controle, sem necessidade de editar o código-fonte para atualizar preços ou adicionar novos lançamentos.

## 🚀 Tecnologias Utilizadas

* **Frontend:** HTML5, CSS3 (CSS Variables, Flexbox, Grid).
* **Backend:** PHP 7/8.
* **Banco de Dados:** MariaDB / MySQL.
* **Servidor Local:** XAMPP (Apache).

## ⚙️ Funcionalidades

* **Página Inicial (Landing Page):**
    * Exibição dinâmica de produtos marcados como "Destaque".
    * Design responsivo (Mobile First).
    * Efeitos de hover e transições CSS.
* **Painel Administrativo:**
    * Visualização de todos os produtos cadastrados.
    * **Upload de imagens:** Sistema para enviar fotos dos produtos para o servidor.
    * **CRUD:** Criação de novos produtos com nome, descrição, preço e foto.

## 📦 Como rodar o projeto

### Pré-requisitos
Para rodar este projeto localmente, precisas de ter instalado um servidor local como o **XAMPP**, **WampServer** ou **Laragon**.

### Passo a Passo

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/PedroBaffa/lponfeet.git
    ```

2.  **Mova os arquivos:**
    Coloque a pasta do projeto dentro do diretório raiz do seu servidor (ex: `C:\xampp\htdocs\lponfeet`).

3.  **Configuração do Banco de Dados:**
    * Abra o seu gerenciador de banco de dados (ex: phpMyAdmin).
    * Crie um banco de dados chamado `lp_on_feet`.
    * Execute o seguinte comando SQL para criar a tabela:

    ```sql
    CREATE TABLE produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10, 2) NOT NULL,
        imagem VARCHAR(255) NOT NULL,
        destaque TINYINT(1) DEFAULT 0,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

4.  **Configuração da Conexão:**
    Verifique o arquivo `config/conexao.php`. Se o seu banco de dados tiver senha (padrão do XAMPP é sem senha), edite esta linha:
    ```php
    $senha = ''; // Coloque sua senha aqui se houver
    ```

5.  **Acesse o projeto:**
    * Loja: `http://localhost/lponfeet/`
    * Painel Admin: `http://localhost/lponfeet/admin/`

## 📂 Estrutura de Pastas

* `admin/` - Scripts do painel de controle (adicionar, listar produtos).
* `assets/` - Imagens estáticas do layout (backgrounds, logos).
* `config/` - Arquivo de conexão com o banco de dados.
* `uploads/` - Destino das imagens dos produtos enviadas pelo admin.
* `index.php` - Página principal da loja.
* `style.css` - Estilos globais.

---

Desenvolvido para fins de estudo e portfólio.