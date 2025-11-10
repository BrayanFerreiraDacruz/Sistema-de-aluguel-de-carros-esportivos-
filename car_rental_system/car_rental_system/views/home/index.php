<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Bem-vindo(a), <?php echo $_SESSION['user_name']; ?>!</h1>
        <p class="lead">Este é o painel de controle do seu sistema de aluguel de carros esportivos.</p>
    </div>
</div>

<div class="row mt-4">
    <?php if (SessionManager::isAdmin()): ?>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-car"></i> Gerenciar Carros</h5>
                    <p class="card-text">Adicione, edite ou remova carros esportivos do catálogo.</p>
                    <a href="<?php echo BASE_URL; ?>?controller=carro&action=index" class="btn btn-light">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-alt"></i> Relatórios</h5>
                    <p class="card-text">Visualize relatórios de aluguéis, faturamento e estoque.</p>
                    <a href="<?php echo BASE_URL; ?>?controller=aluguel&action=relatorio" class="btn btn-light">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Gerenciar Usuários</h5>
                    <p class="card-text">Gerencie as contas de clientes e administradores.</p>
                    <a href="#" class="btn btn-light disabled">Em Breve</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-car-side"></i> Ver Carros Disponíveis</h5>
                    <p class="card-text">Navegue pela nossa frota de carros esportivos e faça sua reserva.</p>
                    <a href="#" class="btn btn-light disabled">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-history"></i> Meus Aluguéis</h5>
                    <p class="card-text">Acompanhe o status dos seus aluguéis atuais e passados.</p>
                    <a href="#" class="btn btn-light disabled">Acessar</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
