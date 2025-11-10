<?php
require_once __DIR__ . '/../models/CarroModel.php';
require_once __DIR__ . '/../utils/SessionManager.php';

class CarroController {
    private $carroModel;

    public function __construct() {
        SessionManager::startSession();
        if (!SessionManager::isAdmin()) {
            // Redireciona para o login se não for admin
            header("Location: " . BASE_URL . "?controller=auth&action=login");
            exit();
        }
        $this->carroModel = new CarroModel();
    }

    /**
     * Lista todos os carros (Read - List).
     */
    public function index() {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
        $limit = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $limit;

        $carros = $this->carroModel->getAllCarros($limit, $offset);
        $totalCarros = $this->carroModel->countAllCarros();
        $totalPages = ceil($totalCarros / $limit);

        $success = $_SESSION['crud_success'] ?? null;
        $error = $_SESSION['crud_error'] ?? null;
        unset($_SESSION['crud_success'], $_SESSION['crud_error']);

        ob_start();
        require_once __DIR__ . '/../views/carro/index.php';
        $content = ob_get_clean();

        $title = "Gerenciar Carros";
        require_once __DIR__ . '/../views/layout/layout.php';
    }

    /**
     * Exibe o formulário de criação de carro (Create - Form).
     */
    public function create() {
        ob_start();
        require_once __DIR__ . '/../views/carro/create.php';
        $content = ob_get_clean();

        $title = "Adicionar Novo Carro";
        require_once __DIR__ . '/../views/layout/layout.php';
    }

    /**
     * Processa a criação de carro (Create - Process).
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateCarroData();

            if ($data) {
                // Adiciona status e imagem_url (pode ser melhorado com upload de arquivo)
                $data['status'] = 'disponivel';
                $data['imagem_url'] = filter_input(INPUT_POST, 'imagem_url', FILTER_SANITIZE_URL) ?: 'default.jpg';

                if ($this->carroModel->createCarro($data)) {
                    $_SESSION['crud_success'] = "Carro adicionado com sucesso!";
                } else {
                    $_SESSION['crud_error'] = "Erro ao adicionar carro. A placa pode já existir.";
                }
            } else {
                $_SESSION['crud_error'] = "Erro de validação. Por favor, preencha todos os campos corretamente.";
            }
        }
        header("Location: " . BASE_URL . "?controller=carro&action=index");
        exit();
    }

    /**
     * Exibe o formulário de edição de carro (Update - Form).
     */
    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $carro = $this->carroModel->getCarroById($id);

        if (!$carro) {
            $_SESSION['crud_error'] = "Carro não encontrado.";
            header("Location: " . BASE_URL . "?controller=carro&action=index");
            exit();
        }

        ob_start();
        require_once __DIR__ . '/../views/carro/edit.php';
        $content = ob_get_clean();

        $title = "Editar Carro";
        require_once __DIR__ . '/../views/layout/layout.php';
    }

    /**
     * Processa a atualização de carro (Update - Process).
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id_carro', FILTER_VALIDATE_INT);
            $data = $this->validateCarroData();

            if ($id && $data) {
                $data['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                $data['imagem_url'] = filter_input(INPUT_POST, 'imagem_url', FILTER_SANITIZE_URL) ?: 'default.jpg';

                if ($this->carroModel->updateCarro($id, $data)) {
                    $_SESSION['crud_success'] = "Carro atualizado com sucesso!";
                } else {
                    $_SESSION['crud_error'] = "Erro ao atualizar carro. A placa pode já existir.";
                }
            } else {
                $_SESSION['crud_error'] = "Erro de validação ou ID inválido.";
            }
        }
        header("Location: " . BASE_URL . "?controller=carro&action=index");
        exit();
    }

    /**
     * Deleta um carro (Delete).
     */
    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            if ($this->carroModel->deleteCarro($id)) {
                $_SESSION['crud_success'] = "Carro excluído com sucesso!";
            } else {
                $_SESSION['crud_error'] = "Erro ao excluir carro. Verifique se não há aluguéis associados.";
            }
        } else {
            $_SESSION['crud_error'] = "ID de carro inválido.";
        }

        header("Location: " . BASE_URL . "?controller=carro&action=index");
        exit();
    }

    /**
     * Validação de dados do carro (Back-end).
     * @return array|false Dados validados ou false em caso de falha.
     */
    private function validateCarroData() {
        $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
        $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT);
        $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
        $placa = filter_input(INPUT_POST, 'placa', FILTER_SANITIZE_STRING);
        $preco_diario = filter_input(INPUT_POST, 'preco_diario', FILTER_VALIDATE_FLOAT);

        if (empty($marca) || empty($modelo) || empty($placa) || !$ano || !$preco_diario) {
            return false;
        }

        return [
            'marca' => $marca,
            'modelo' => $modelo,
            'ano' => $ano,
            'cor' => $cor,
            'placa' => $placa,
            'preco_diario' => $preco_diario,
        ];
    }
}
