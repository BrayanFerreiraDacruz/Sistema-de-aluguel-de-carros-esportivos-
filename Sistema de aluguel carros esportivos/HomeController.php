<?php
require_once __DIR__ . '/../utils/SessionManager.php';

class HomeController {
    public function index() {
        // Redireciona para o login se não estiver logado
        if (!SessionManager::isLoggedIn()) {
            header("Location: " . BASE_URL . "?controller=auth&action=login");
            exit();
        }

        // Conteúdo da página inicial
        ob_start();
        require_once __DIR__ . '/../views/home/index.php';
        $content = ob_get_clean();

        // Inclui o layout
        $title = "Dashboard";
        require_once __DIR__ . '/../views/layout/layout.php';
    }
}
