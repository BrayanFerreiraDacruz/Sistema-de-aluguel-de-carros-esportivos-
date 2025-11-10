<?php
require_once 'Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Busca um usuário pelo email.
     * @param string $email
     * @return array|false
     */
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Registra um novo usuário.
     * @param string $nome
     * @param string $email
     * @param string $senha_pura
     * @param string $telefone
     * @param string $tipo_usuario
     * @return bool
     */
    public function registerUser($nome, $email, $senha_pura, $telefone = null, $tipo_usuario = 'cliente') {
        // Hash de senhas usando password_hash
        $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, tipo_usuario) VALUES (:nome, :email, :senha, :telefone, :tipo_usuario)";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha_hash);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            return $stmt->execute();
        } catch (\PDOException $e) {
            // Em caso de erro (ex: email duplicado), retorna false
            return false;
        }
    }

    /**
     * Verifica as credenciais do usuário para login.
     * @param string $email
     * @param string $senha_pura
     * @return array|false O registro do usuário se o login for bem-sucedido, caso contrário, false.
     */
    public function login($email, $senha_pura) {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($senha_pura, $user['senha'])) {
            // Login bem-sucedido
            return $user;
        }

        // Login falhou
        return false;
    }
}
