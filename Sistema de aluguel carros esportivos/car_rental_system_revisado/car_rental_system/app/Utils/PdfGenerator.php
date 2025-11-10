<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use Fpdf\Fpdf;

class PdfGenerator {
    public function generatePdf($htmlContent, $filename) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo "Conteúdo do Relatório em PDF (Simulação):\n\n";
        echo strip_tags($htmlContent);
        
        exit;
    }
}
