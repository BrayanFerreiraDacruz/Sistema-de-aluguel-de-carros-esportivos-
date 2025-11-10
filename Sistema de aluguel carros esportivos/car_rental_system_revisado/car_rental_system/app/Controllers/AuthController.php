<?php
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Utils/SessionManager.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
        SessionManager::startSession();
    }

    public function login() {
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);
        require_once __DIR__ . '/../../../views/auth/login.php';
    }

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

            if (empty($email) || empty($senha)) {
                $_SESSION['login_error'] = "Todos os campos são obrigatórios.";
                header("Location: " . BASE_URL . "?controller=auth&action=login");
                exit();
            }

            $user = $this->userModel->login($email, $senha);

            if ($user) {
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['user_name'] = $user['nome'];
                $_SESSION['user_type'] = $user['tipo_usuario'];
                
                if ($user['tipo_usuario'] === 'admin') {
                    header("Location: " . BASE_URL . "?controller=home&action=index");
                } else {
                    header("Location: " . BASE_URL . "?controller=home&action=index");
                }
                exit();
            } else {
                $_SESSION['login_error'] = "Email ou senha inválidos.";
                header("Location: " . BASE_URL . "?controller=auth&action=login");
                exit();
            }
        }
        header("Location: " . BASE_URL . "?controller=auth&action=login");
        exit();
    }

    public function logout() {
        SessionManager::destroySession();
        header("Location: " . BASE_URL . "?controller=auth&action=login");
        exit();
    }

    public function register() {
        $error = $_SESSION['register_error'] ?? null;
        unset($_SESSION['register_error']);
        require_once __DIR__ . '/../../../views/auth/register.php';
    }

    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $confirma_senha = filter_input(INPUT_POST, 'confirma_senha', FILTER_SANITIZE_STRING);

            if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
                $_SESSION['register_error'] = "Todos os campos obrigatórios devem ser preenchidos.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['register_error'] = "Formato de email inválido.";
            } elseif ($senha !== $confirma_senha) {
                $_SESSION['register_error'] = "As senhas não coincidem.";
            } else {
                if ($this->userModel->registerUser($nome, $email, $senha, $telefone)) {
                    $_SESSION['login_success'] = "Cadastro realizado com sucesso! Faça login para continuar.";
                    header("Location: " . BASE_URL . "?controller=auth&action=login");
                    exit();
                } else {
                    $_SESSION['register_error'] = "Erro ao registrar. O email pode já estar em uso.";
                }
            }
            
            header("Location: " . BASE_URL . "?controller=auth&action=register");
            exit();
        }
        header("Location: " . BASE_URL . "?controller=auth&action=register");
        exit();
    }
}
