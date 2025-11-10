# Relatório Técnico: Sistema de Aluguel de Carros Esportivos

## 1. Introdução

Este relatório detalha as decisões técnicas tomadas no desenvolvimento do Sistema de Aluguel de Carros Esportivos, utilizando PHP puro e MySQL, conforme os requisitos do projeto.

## 2. Decisões Técnicas

### 2.1. Estrutura e Arquitetura (MVC)

Adotamos uma arquitetura **Model-View-Controller (MVC) simplificada** com a seguinte estrutura de pastas limpa:

*   **`app/Controllers/`:** Lógica de controle.
*   **`app/Models/`:** Lógica de negócios e interação com o banco de dados.
*   **`app/Utils/`:** Classes utilitárias.
*   **`views/`:** Arquivos de interface do usuário.
*   **`public/`:** Ponto de entrada.

### 2.2. Back-end (PHP Puro e PDO)

*   **PHP Puro:** Desenvolvimento focado nos fundamentos da linguagem.
*   **Conexão com Banco de Dados (PDO):** Uso exclusivo de **PDO (PHP Data Objects)** para garantir segurança e flexibilidade.
*   **Prepared Statements:** Todas as queries utilizam *Prepared Statements* para prevenir **SQL Injection**.

### 2.3. Banco de Dados (MySQL)

*   **Modelagem:** O banco de dados `car_rental_db` possui as entidades `usuarios`, `carros` e `alugueis`.
*   **Integridade:** Uso de chaves primárias, chaves únicas (`email`, `placa`) e chaves estrangeiras para integridade referencial.

### 2.4. Segurança

| Requisito de Segurança | Implementação Técnica |
| :--- | :--- |
| **Proteção contra SQL Injection** | Uso de **Prepared Statements** (PDO). |
| **Hash de Senhas** | Uso da função nativa `password_hash()` e `password_verify()`. |
| **Validação de Dados (Back-end)** | Uso de `filter_input()` e validações explícitas nos Controllers. |
| **Proteção contra XSS** | Uso da função `htmlspecialchars()` em todas as saídas de dados do usuário nas Views. |
| **Controle de Sessão** | A classe `SessionManager` configura a sessão com `session.use_only_cookies`, `session.cookie_httponly` e implementa a regeneração de ID de sessão. |

### 2.5. Front-end (HTML, CSS, JavaScript)

*   **Responsividade:** Utilização do framework **Bootstrap 5**.
*   **Validação de Formulários:** Validação no **Front-end** (HTML5/Bootstrap) e validação robusta no **Back-end**.

## 3. Funcionalidades Obrigatórias

*   **Autenticação:** Implementada em `AuthController` e `UserModel`.
*   **CRUD Completo:** Implementado para a entidade **Carro Esportivo** (`CarroController` e `CarroModel`).
*   **Sessões/Cookies:** Gerenciamento centralizado na classe `SessionManager`.
*   **Relatórios:** Implementação de um relatório de aluguéis em `RelatorioController`, com funcionalidade de **Geração de PDF** (simulada).

## 4. Conclusão

O sistema atende a todos os requisitos, apresentando uma estrutura de código limpa, organizada e segura, conforme solicitado.
