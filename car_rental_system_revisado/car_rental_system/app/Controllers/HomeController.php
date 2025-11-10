<?php
require_once __DIR__ . '/../Utils/SessionManager.php';

class HomeController {
    public function index() {
        if (!SessionManager::isLoggedIn()) {
            header("Location: " . BASE_URL . "?controller=auth&action=login");
            exit();
        }

        ob_start();
        require_once __DIR__ . '/../../../views/home/index.php';
        $content = ob_get_clean();

        $title = "Dashboard";
        require_once __DIR__ . '/../../../views/layout/layout.php';
    }
}
