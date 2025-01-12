<!-- registo.php -->
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <form id="register-form" method="POST" action="process_register.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="num_identificacao">Número de Identificação:</label>
        <input type="text" id="num_identificacao" name="num_identificacao" required><br>

        <label for="contacto">Contacto:</label>
        <input type="tel" id="contacto" name="contacto" required><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Cadastrar">
    </form>

    <script src="script.js"></script>  <!-- Incluindo o arquivo script.js para validação -->
</body>
</html>


<!--// script.js
document.getElementById('register-form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!validateEmail(email)) {
        alert('Por favor, insira um email válido.');
        e.preventDefault();  // Previne o envio do formulário
        return;
    }

    if (password.length < 6) {
        alert('A senha deve ter pelo menos 6 caracteres.');
        e.preventDefault();  // Previne o envio do formulário
        return;
    }
});

function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}
-->