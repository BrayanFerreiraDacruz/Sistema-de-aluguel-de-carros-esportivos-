<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'car_rental_db');
define('DB_USER', 'root'); // Usuário padrão do sandbox
define('DB_PASS', ''); // Senha padrão do sandbox

// Configurações do Sistema
define('BASE_URL', 'http://localhost:8000/'); // URL base para links e redirecionamentos

// Configurações de Segurança
define('SECRET_KEY', 'sua_chave_secreta_aqui_para_sessoes'); // Chave para criptografia de sessão

// Configurações de Paginacao
define('ITEMS_PER_PAGE', 10);

// Configurações de Email (para recuperação de senha, se implementado)
// define('MAIL_HOST', 'smtp.exemplo.com');
// define('MAIL_USER', 'seu_email@exemplo.com');
// define('MAIL_PASS', 'sua_senha_de_email');
// define('MAIL_FROM', 'noreply@carrental.com');
