<?php
require_once __DIR__ . '/../config/config.php';

class SessionManager {
    /**
     * Inicia a sessão se ainda não estiver iniciada.
     */
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            // Configurações de segurança para a sessão
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', 0); // Deve ser 1 em produção com HTTPS

            // Define o nome da sessão
            session_name('CarRentalSession');
            
            // Inicia a sessão
            session_start();
            
            // Proteção contra Session Fixation (regenera o ID da sessão a cada X requisições ou tempo)
            if (!isset($_SESSION['CREATED'])) {
                $_SESSION['CREATED'] = time();
            } else if (time() - $_SESSION['CREATED'] > 1800) { // 30 minutos
                session_regenerate_id(true);
                $_SESSION['CREATED'] = time();
            }
        }
    }

    /**
     * Verifica se o usuário está logado.
     * @return bool
     */
    public static function isLoggedIn() {
        self::startSession();
        return isset($_SESSION['user_id']);
    }

    /**
     * Verifica se o usuário logado é um administrador.
     * @return bool
     */
    public static function isAdmin() {
        self::startSession();
        return isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
    }

    /**
     * Destrói a sessão atual.
     */
    public static function destroySession() {
        self::startSession();
        // Limpa todas as variáveis de sessão
        $_SESSION = array();

        // Obtém os parâmetros do cookie de sessão
        $params = session_get_cookie_params();

        // Destrói o cookie de sessão
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );

        // Finalmente, destrói a sessão
        session_destroy();
    }
}
