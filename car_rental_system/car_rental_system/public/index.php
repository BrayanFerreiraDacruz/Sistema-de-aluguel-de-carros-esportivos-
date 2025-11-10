<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../utils/SessionManager.php';

// Inicia a sessão
SessionManager::startSession();

// Define o controlador e a ação padrão
$controllerName = $_GET['controller'] ?? 'home';
$actionName = $_GET['action'] ?? 'index';

// Converte o nome do controlador para o formato de classe
$controllerClass = ucfirst(strtolower($controllerName)) . 'Controller';
$controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';

// Verifica se o arquivo do controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Verifica se a classe existe
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        // Verifica se o método (ação) existe
        if (method_exists($controller, $actionName)) {
            // Executa a ação
            $controller->$actionName();
        } else {
            // Ação não encontrada
            http_response_code(404);
            echo "Erro 404: Ação '{$actionName}' não encontrada no controlador '{$controllerClass}'.";
        }
    } else {
        // Classe não encontrada (deve ser rara se o arquivo existir)
        http_response_code(500);
        echo "Erro 500: Classe '{$controllerClass}' não encontrada.";
    }
} else {
    // Controlador não encontrado
    // Se o controlador for 'home', cria um controlador básico para evitar erro 404 inicial
    if ($controllerName === 'home') {
        // Cria um controlador HomeController básico
        class HomeController {
            public function index() {
                // Redireciona para o login se não estiver logado
                if (!SessionManager::isLoggedIn()) {
                    header("Location: " . BASE_URL . "?controller=auth&action=login");
                    exit();
                }
                // Se estiver logado, exibe a página inicial (será criada na próxima fase)
                echo "Página Inicial (Dashboard) - Olá, " . $_SESSION['user_name'] . "!";
            }
        }
        $controller = new HomeController();
        $controller->index();
    } else {
        http_response_code(404);
        echo "Erro 404: Controlador '{$controllerClass}' não encontrado.";
    }
}
