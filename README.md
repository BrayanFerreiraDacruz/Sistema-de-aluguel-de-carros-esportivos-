# Sistema-de-aluguel-de-carros-esportivos-


Sistema de Aluguel de Carros Esportivos

Este é um sistema web completo desenvolvido em PHP puro com MySQL, seguindo uma arquitetura MVC simplificada.

**Requisit**os

•
Servidor Web (Apache, Nginx ou Servidor de Desenvolvimento PHP)

•
PHP 8.1+

•
MySQL 8.0+

•
Extensão PHP pdo_mysql

Estrutura do Projeto

•
app/Controllers/: Lógica de controle.

•
app/Models/: Lógica de negócios e interação com o banco de dados (PDO).

•
app/Utils/: Classes utilitárias (SessionManager, PdfGenerator).

•
config/: Arquivos de configuração.

•
public/: Ponto de entrada do sistema (index.php).

•
views/: Arquivos de interface do usuário (HTML/PHP).

•
database/: Script SQL para criação do banco de dados.

•
docs/: Documentação (README, Relatório, ERD).

Instalação e Execução

1. Configuração do Banco de Dados

1.
Crie um banco de dados MySQL chamado car_rental_db.

2.
Importe o script SQL:

•
Usuário Administrador Padrão:

•
Email: admin@carrental.com

•
Senha: admin123





3.
Verifique e ajuste as credenciais de conexão no arquivo config/config.php se necessário.

2. Configuração do Servidor Web

1.
Configure seu servidor web (Apache/Nginx) para que a raiz do documento aponte para a pasta public/.

2.
Alternativa (Servidor de Desenvolvimento PHP): Acesse a pasta public/ e execute o servidor embutido do PHP:

3. Acesso ao Sistema

1.
Abra seu navegador e acesse: http://localhost:8000.

2.
Você será redirecionado para a página de Login.

Funcionalidades Implementadas

•
Autenticação: Login e Logout.

•
Cadastro de Usuários: Clientes podem se registrar.

•
CRUD Completo: Gerenciamento de Carros Esportivos (apenas para administradores ).

•
Segurança: Proteção contra SQL Injection (PDO Prepared Statements) e Hash de Senhas (password_hash).

•
Front-end: Interface responsiva usando Bootstrap 5.

•
Relatórios: Geração de relatório de aluguéis (emulando PDF).

