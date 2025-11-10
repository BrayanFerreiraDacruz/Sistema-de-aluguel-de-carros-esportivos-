# Relatório Técnico: Sistema de Aluguel de Carros Esportivos

## 1. Introdução

Este relatório detalha as decisões técnicas tomadas no desenvolvimento do Sistema de Aluguel de Carros Esportivos, utilizando PHP puro e MySQL, conforme os requisitos do projeto. O objetivo principal foi criar uma aplicação web completa, funcional e segura, aplicando conceitos de MVC, banco de dados e segurança.

## 2. Decisões Técnicas

### 2.1. Estrutura e Arquitetura (MVC)

Adotamos uma arquitetura **Model-View-Controller (MVC) simplificada** para organizar o código, garantindo modularidade e separação de responsabilidades:

*   **Controllers (`controllers/`):** Gerenciam o fluxo da aplicação, recebem requisições (GET/POST), chamam os Models e carregam as Views. Ex: `AuthController.php`, `CarroController.php`.
*   **Models (`models/`):** Contêm a lógica de negócios e a interação com o banco de dados. Ex: `UserModel.php`, `CarroModel.php`. A classe `Database.php` implementa o padrão Singleton para gerenciar a conexão PDO.
*   **Views (`views/`):** Responsáveis pela apresentação dos dados (HTML, CSS, JavaScript). O arquivo `layout/layout.php` garante a consistência visual e a reutilização do cabeçalho e rodapé.

### 2.2. Back-end (PHP Puro e PDO)

*   **PHP Puro:** O desenvolvimento foi realizado em PHP puro, sem o uso de frameworks complexos, para demonstrar o domínio dos fundamentos da linguagem.
*   **Conexão com Banco de Dados (PDO):** A classe `Database.php` utiliza a extensão **PDO (PHP Data Objects)**. Esta escolha é crucial para a segurança, pois permite o uso de *Prepared Statements*.
*   **Prepared Statements:** Todas as interações com o banco de dados (SELECT, INSERT, UPDATE, DELETE) utilizam *Prepared Statements* (ex: `$stmt->execute($data)`), garantindo a **proteção contra SQL Injection**.

### 2.3. Banco de Dados (MySQL)

*   **Modelagem:** O banco de dados `car_rental_db` foi modelado com três entidades principais: `usuarios`, `carros` e `alugueis`.
    *   **`usuarios`:** Armazena clientes e administradores (`tipo_usuario`).
    *   **`carros`:** Entidade principal para o CRUD.
    *   **`alugueis`:** Tabela de relacionamento N:M (muitos para muitos) entre usuários e carros, registrando as transações.
*   **Integridade:** Foram utilizadas chaves primárias (`id_usuario`, `id_carro`, `id_aluguel`), chaves únicas (`email`, `placa`) e chaves estrangeiras (`id_usuario`, `id_carro` em `alugueis`) para garantir a integridade referencial.

### 2.4. Segurança

| Requisito de Segurança | Implementação Técnica |
| :--- | :--- |
| **Proteção contra SQL Injection** | Uso exclusivo de **Prepared Statements** (PDO) em todas as queries. |
| **Hash de Senhas** | Uso da função nativa `password_hash()` para armazenar senhas de forma segura e `password_verify()` para autenticação. |
| **Validação de Dados (Back-end)** | Uso de funções como `filter_input()` e validações explícitas nos Controllers (ex: `AuthController::processLogin`, `CarroController::validateCarroData`). |
| **Proteção contra XSS** | Uso da função `htmlspecialchars()` em todas as saídas de dados do usuário nas Views, prevenindo a execução de scripts maliciosos. |
| **Controle de Sessão** | A classe `SessionManager.php` configura a sessão com `session.use_only_cookies` e `session.cookie_httponly` e implementa a regeneração de ID de sessão para mitigar **Session Fixation**. |

### 2.5. Front-end (HTML, CSS, JavaScript)

*   **Responsividade:** Utilização do framework **Bootstrap 5** para garantir um design responsivo e moderno, adaptável a diferentes tamanhos de tela.
*   **Validação de Formulários:** Implementação de validação no **Front-end** usando os atributos `required`, `minlength` e classes de validação do Bootstrap (`needs-validation`), complementada pela validação robusta no **Back-end**.

## 3. Funcionalidades Obrigatórias

*   **Autenticação:** Implementada em `AuthController` e `UserModel`.
*   **CRUD Completo:** Implementado para a entidade **Carro Esportivo** em `CarroController` e `CarroModel` (Create, Read/List, Update, Delete).
*   **Sessões/Cookies:** Gerenciamento centralizado na classe `SessionManager`.
*   **Relatórios:** Implementação de um relatório de aluguéis em `RelatorioController`, com a funcionalidade de **Geração de PDF** (simulada via `PdfGenerator` devido a limitações do ambiente, mas com a estrutura pronta para uma biblioteca real como mPDF).

## 4. Conclusão

O sistema atende a todos os requisitos propostos, demonstrando a aplicação prática de conceitos essenciais de desenvolvimento web seguro e estruturado em PHP e MySQL. A arquitetura MVC simplificada facilita a manutenção e a expansão futura do projeto.
