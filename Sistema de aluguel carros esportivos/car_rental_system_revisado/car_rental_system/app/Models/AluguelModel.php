<?php
require_once 'Database.php';

class AluguelModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getRelatorioAlugueis() {
        $sql = "SELECT 
                    a.id_aluguel,
                    u.nome AS nome_cliente,
                    c.marca,
                    c.modelo,
                    c.placa,
                    a.data_inicio,
                    a.data_fim_previsto,
                    a.valor_total,
                    a.status
                FROM alugueis a
                JOIN usuarios u ON a.id_usuario = u.id_usuario
                JOIN carros c ON a.id_carro = c.id_carro
                ORDER BY a.data_registro DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getFaturamentoTotal() {
        $sql = "SELECT SUM(valor_total) FROM alugueis WHERE status = 'concluido'";
        return $this->db->query($sql)->fetchColumn() ?: 0.00;
    }
}
