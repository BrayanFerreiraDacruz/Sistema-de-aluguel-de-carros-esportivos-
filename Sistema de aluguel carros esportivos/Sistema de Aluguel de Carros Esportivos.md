# Sistema de Aluguel de Carros Esportivos

Este é um sistema web completo desenvolvido em PHP puro com MySQL, seguindo o padrão MVC (Model-View-Controller) simplificado, conforme os requisitos do trabalho.

## Requisitos

*   Servidor Web (Apache, Nginx ou Servidor de Desenvolvimento PHP)
*   PHP 8.1+
*   MySQL 8.0+
*   Extensão PHP `pdo_mysql`

## Estrutura do Projeto

*   `config/`: Arquivos de configuração (ex: conexão com o banco de dados).
*   `controllers/`: Lógica de controle (recebe requisições e chama Models/Views).
*   `models/`: Lógica de negócios e interação com o banco de dados (PDO).
*   `views/`: Arquivos de interface do usuário (HTML/PHP).
*   `public/`: Ponto de entrada do sistema (`index.php`).
*   `utils/`: Classes utilitárias (ex: `SessionManager`, `PdfGenerator`).
*   `database/`: Script SQL para criação do banco de dados.
*   `documentation/`: Diagrama ER.

## Instalação e Execução

### 1. Configuração do Banco de Dados

1.  Crie um banco de dados MySQL chamado `car_rental_db`.
2.  Importe o script SQL:
    ```bash
    mysql -u seu_usuario -p car_rental_db < database/car_rental_db.sql
    ```
    *   **Usuário Administrador Padrão:**
        *   **Email:** `admin@carrental.com`
        *   **Senha:** `admin123` (A senha está hasheada no banco de dados, mas o valor original é `admin123`).

3.  Verifique e ajuste as credenciais de conexão no arquivo `config/config.php` se necessário.

### 2. Configuração do Servidor Web

1.  Configure seu servidor web (Apache/Nginx) para que a raiz do documento aponte para a pasta `public/`.
2.  **Alternativa (Servidor de Desenvolvimento PHP):**
    Acesse a pasta `public/` e execute o servidor embutido do PHP:
    ```bash
    cd public
    php -S localhost:8000
    ```

### 3. Acesso ao Sistema

1.  Abra seu navegador e acesse: `http://localhost:8000` (ou a URL configurada no seu servidor).
2.  Você será redirecionado para a página de Login.

## Funcionalidades Implementadas

*   **Autenticação:** Login e Logout (com controle de sessão seguro).
*   **Cadastro de Usuários:** Clientes podem se registrar.
*   **CRUD Completo:** Gerenciamento de **Carros Esportivos** (apenas para administradores).
*   **Segurança:** Proteção contra SQL Injection (uso de Prepared Statements com PDO) e Hash de Senhas (`password_hash`).
*   **Front-end:** Interface responsiva usando **Bootstrap 5**.
*   **Relatórios:** Geração de relatório de aluguéis (emulando PDF).
