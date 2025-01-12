<!-- login.php -->
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Lux Portugal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <h2>Login</h2>

    <form id="login-form" method="POST" action="process_login.php">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Entrar">
    </form>

    <script src="script.js"></script>  <!-- Incluindo o arquivo script.js para validação -->
</body>
</html>
