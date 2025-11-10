<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório de Aluguéis</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        h1 { text-align: center; color: #333; }
        .summary { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Relatório de Aluguéis - CarRental</h1>
    <p>Gerado em: <?php echo date('d/m/Y H:i:s'); ?></p>

    <div class="summary">
        <h2>Resumo Financeiro</h2>
        <p>Faturamento Total (Aluguéis Concluídos): <span class="text-success">R$ <?php echo number_format($faturamentoTotal, 2, ',', '.'); ?></span></p>
    </div>

    <h2>Detalhes dos Aluguéis</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Carro</th>
                <th>Placa</th>
                <th>Início</th>
                <th>Fim Previsto</th>
                <th>Valor Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($relatorioAlugueis)): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Nenhum aluguel registrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($relatorioAlugueis as $aluguel): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($aluguel['id_aluguel']); ?></td>
                        <td><?php echo htmlspecialchars($aluguel['nome_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($aluguel['marca'] . ' ' . $aluguel['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($aluguel['placa']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($aluguel['data_inicio'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($aluguel['data_fim_previsto'])); ?></td>
                        <td>R$ <?php echo number_format($aluguel['valor_total'], 2, ',', '.'); ?></td>
                        <td><?php echo ucfirst($aluguel['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
