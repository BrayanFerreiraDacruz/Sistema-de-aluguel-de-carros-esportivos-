<?php
require_once __DIR__ . '/../Models/AluguelModel.php';
require_once __DIR__ . '/../Utils/SessionManager.php';
require_once __DIR__ . '/../Utils/PdfGenerator.php';

class RelatorioController {
    private $aluguelModel;

    public function __construct() {
        SessionManager::startSession();
        if (!SessionManager::isAdmin()) {
            header("Location: " . BASE_URL . "?controller=auth&action=login");
            exit();
        }
        $this->aluguelModel = new AluguelModel();
    }

    public function relatorio() {
        $relatorioAlugueis = $this->aluguelModel->getRelatorioAlugueis();
        $faturamentoTotal = $this->aluguelModel->getFaturamentoTotal();

        ob_start();
        require_once __DIR__ . '/../../../views/relatorio/index.php';
        $content = ob_get_clean();

        $title = "Relatórios do Sistema";
        require_once __DIR__ . '/../../../views/layout/layout.php';
    }

    public function gerarPdf() {
        $relatorioAlugueis = $this->aluguelModel->getRelatorioAlugueis();
        $faturamentoTotal = $this->aluguelModel->getFaturamentoTotal();

        ob_start();
        require_once __DIR__ . '/../../../views/relatorio/pdf_template.php';
        $htmlContent = ob_get_clean();

        $pdfGenerator = new PdfGenerator();
        $pdfGenerator->generatePdf($htmlContent, 'Relatorio_Alugueis_' . date('Ymd') . '.pdf');
    }
}
