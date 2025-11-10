<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Gerenciamento de Carros Esportivos</h1>
        <a href="<?php echo BASE_URL; ?>?controller=carro&action=create" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Adicionar Novo Carro</a>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Preço Diário</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($carros)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Nenhum carro encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($carros as $carro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($carro['id_carro']); ?></td>
                                <td><?php echo htmlspecialchars($carro['marca']); ?></td>
                                <td><?php echo htmlspecialchars($carro['modelo']); ?></td>
                                <td><?php echo htmlspecialchars($carro['ano']); ?></td>
                                <td><?php echo htmlspecialchars($carro['placa']); ?></td>
                                <td>R$ <?php echo number_format($carro['preco_diario'], 2, ',', '.'); ?></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        if ($carro['status'] == 'disponivel') echo 'success';
                                        else if ($carro['status'] == 'alugado') echo 'warning';
                                        else echo 'danger';
                                    ?>">
                                        <?php echo ucfirst($carro['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>?controller=carro&action=edit&id=<?php echo $carro['id_carro']; ?>" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo BASE_URL; ?>?controller=carro&action=delete&id=<?php echo $carro['id_carro']; ?>" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este carro?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo BASE_URL; ?>?controller=carro&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>
