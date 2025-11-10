<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Utils/SessionManager.php';

SessionManager::startSession();

$controllerName = $_GET['controller'] ?? 'home';
$actionName = $_GET['action'] ?? 'index';

$controllerClass = ucfirst(strtolower($controllerName)) . 'Controller';
$controllerFile = __DIR__ . '/../app/Controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            http_response_code(404);
            echo "Erro 404: Ação '{$actionName}' não encontrada no controlador '{$controllerClass}'.";
        }
    } else {
        http_response_code(500);
        echo "Erro 500: Classe '{$controllerClass}' não encontrada.";
    }
} else {
    if ($controllerName === 'home') {
        class HomeController {
            public function index() {
                if (!SessionManager::isLoggedIn()) {
                    header("Location: " . BASE_URL . "?controller=auth&action=login");
                    exit();
                }
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
