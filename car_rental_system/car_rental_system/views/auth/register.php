<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Aluguel de Carros Esportivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .register-container { max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="text-center mb-4">Crie sua Conta</h2>
        
        <?php if (isset($_SESSION['register_error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></div>
        <?php endif; ?>

        <form action="?controller=auth&action=processRegister" method="POST" id="registerForm" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
                <div class="invalid-feedback">Por favor, insira seu nome.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Por favor, insira um email válido.</div>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone (Opcional)</label>
                <input type="tel" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required minlength="6">
                <div class="invalid-feedback">A senha deve ter no mínimo 6 caracteres.</div>
            </div>
            <div class="mb-3">
                <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
                <div class="invalid-feedback">As senhas não coincidem.</div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>Já tem uma conta? <a href="?controller=auth&action=login">Faça login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

        // Validação extra para confirmar senha
        const password = document.getElementById('senha');
        const confirmPassword = document.getElementById('confirma_senha');

        function validatePassword(){
            if(password.value != confirmPassword.value) {
                confirmPassword.setCustomValidity("As senhas não coincidem");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirmPassword.onkeyup = validatePassword;
    </script>
</body>
</html>
