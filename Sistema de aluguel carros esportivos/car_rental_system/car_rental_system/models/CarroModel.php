<?php
require_once 'Database.php';

class CarroModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Cria um novo carro.
     * @param array $data Dados do carro.
     * @return bool
     */
    public function createCarro($data) {
        $sql = "INSERT INTO carros (marca, modelo, ano, cor, placa, preco_diario, status, imagem_url) 
                VALUES (:marca, :modelo, :ano, :cor, :placa, :preco_diario, :status, :imagem_url)";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($data);
        } catch (\PDOException $e) {
            // Em caso de erro (ex: placa duplicada), retorna false
            return false;
        }
    }

    /**
     * Busca um carro pelo ID.
     * @param int $id
     * @return array|false
     */
    public function getCarroById($id) {
        $sql = "SELECT * FROM carros WHERE id_carro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Retorna todos os carros com paginação.
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAllCarros($limit = 10, $offset = 0) {
        $sql = "SELECT * FROM carros ORDER BY marca, modelo LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Conta o total de carros.
     * @return int
     */
    public function countAllCarros() {
        $sql = "SELECT COUNT(*) FROM carros";
        return $this->db->query($sql)->fetchColumn();
    }

    /**
     * Atualiza um carro.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCarro($id, $data) {
        $sql = "UPDATE carros SET 
                marca = :marca, 
                modelo = :modelo, 
                ano = :ano, 
                cor = :cor, 
                placa = :placa, 
                preco_diario = :preco_diario, 
                status = :status, 
                imagem_url = :imagem_url 
                WHERE id_carro = :id";
        
        try {
            $data['id'] = $id;
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($data);
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Deleta um carro.
     * @param int $id
     * @return bool
     */
    public function deleteCarro($id) {
        $sql = "DELETE FROM carros WHERE id_carro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
