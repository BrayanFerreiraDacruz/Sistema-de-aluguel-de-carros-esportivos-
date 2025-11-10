<?php
require_once __DIR__ . '/../models/AluguelModel.php';
require_once __DIR__ . '/../utils/SessionManager.php';
require_once __DIR__ . '/../utils/PdfGenerator.php'; // Para geração de relatórios em PDF

class RelatorioController {
    private $aluguelModel;

    public function __construct() {
        SessionManager::startSession();
        if (!SessionManager::isAdmin()) {
            // Redireciona para o login se não for admin
            header("Location: " . BASE_URL . "?controller=auth&action=login");
            exit();
        }
        $this->aluguelModel = new AluguelModel();
    }

    /**
     * Exibe a página de relatórios.
     */
    public function relatorio() {
        $relatorioAlugueis = $this->aluguelModel->getRelatorioAlugueis();
        $faturamentoTotal = $this->aluguelModel->getFaturamentoTotal();

        ob_start();
        require_once __DIR__ . '/../views/relatorio/index.php';
        $content = ob_get_clean();

        $title = "Relatórios do Sistema";
        require_once __DIR__ . '/../views/layout/layout.php';
    }

    /**
     * Gera o relatório em PDF.
     */
    public function gerarPdf() {
        $relatorioAlugueis = $this->aluguelModel->getRelatorioAlugueis();
        $faturamentoTotal = $this->aluguelModel->getFaturamentoTotal();

        // Conteúdo HTML que será convertido para PDF
        ob_start();
        require_once __DIR__ . '/../views/relatorio/pdf_template.php';
        $htmlContent = ob_get_clean();

        $pdfGenerator = new PdfGenerator();
        $pdfGenerator->generatePdf($htmlContent, 'Relatorio_Alugueis_' . date('Ymd') . '.pdf');
    }
}
