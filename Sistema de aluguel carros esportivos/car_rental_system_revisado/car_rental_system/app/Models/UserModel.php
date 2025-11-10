<?php
require_once 'Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function registerUser($nome, $email, $senha_pura, $telefone = null, $tipo_usuario = 'cliente') {
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
            return false;
        }
    }

    public function login($email, $senha_pura) {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($senha_pura, $user['senha'])) {
            return $user;
        }

        return false;
    }
}
