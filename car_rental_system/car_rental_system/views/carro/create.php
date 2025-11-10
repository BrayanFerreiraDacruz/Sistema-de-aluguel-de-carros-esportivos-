<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="mb-4">Adicionar Novo Carro Esportivo</h1>
        <form action="<?php echo BASE_URL; ?>?controller=carro&action=store" method="POST" class="needs-validation" novalidate>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                    <div class="invalid-feedback">A marca é obrigatória.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                    <div class="invalid-feedback">O modelo é obrigatório.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" required min="1900" max="<?php echo date('Y') + 1; ?>">
                    <div class="invalid-feedback">O ano é obrigatório e deve ser válido.</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cor" class="form-label">Cor</label>
                    <input type="text" class="form-control" id="cor" name="cor">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" required maxlength="10">
                    <div class="invalid-feedback">A placa é obrigatória.</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="preco_diario" class="form-label">Preço Diário (R$)</label>
                <input type="number" step="0.01" class="form-control" id="preco_diario" name="preco_diario" required min="0.01">
                <div class="invalid-feedback">O preço diário é obrigatório e deve ser maior que zero.</div>
            </div>

            <div class="mb-3">
                <label for="imagem_url" class="form-label">URL da Imagem (Opcional)</label>
                <input type="url" class="form-control" id="imagem_url" name="imagem_url">
            </div>

            <button type="submit" class="btn btn-success">Salvar Carro</button>
            <a href="<?php echo BASE_URL; ?>?controller=carro&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
    // Ativa a validação do Bootstrap
    (function () {
      'use strict'

      var forms = document.querySelectorAll('.needs-validation')

      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
</script>
