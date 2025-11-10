<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Relatórios Gerenciais</h1>

        <div class="card mb-4">
            <div class="card-header">
                Resumo Financeiro
            </div>
            <div class="card-body">
                <h5 class="card-title">Faturamento Total (Aluguéis Concluídos)</h5>
                <p class="card-text fs-3 text-success">R$ <?php echo number_format($faturamentoTotal, 2, ',', '.'); ?></p>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Relatório de Aluguéis</h2>
            <a href="<?php echo BASE_URL; ?>?controller=relatorio&action=gerarPdf" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Gerar PDF</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
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
                            <td colspan="8" class="text-center">Nenhum aluguel registrado.</td>
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
                                <td>
                                    <span class="badge bg-<?php 
                                        if ($aluguel['status'] == 'concluido') echo 'success';
                                        else if ($aluguel['status'] == 'ativo') echo 'primary';
                                        else if ($aluguel['status'] == 'pendente') echo 'warning';
                                        else echo 'danger';
                                    ?>">
                                        <?php echo ucfirst($aluguel['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
