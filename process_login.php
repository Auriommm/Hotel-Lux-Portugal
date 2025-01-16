<?php
session_start();
require_once 'config.php';  // Arquivo de conexão com o banco de dados

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Função para validar o login
    function login_cliente($email, $senha) {
        global $conn;

        // Consulta para verificar se o e-mail existe
        $query = "SELECT idcliente, password_hash FROM cliente WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password_hash);
            $stmt->fetch();

            // Verificando se a senha está correta
            if (password_verify($senha, $password_hash)) {
                $_SESSION['cliente_id'] = $id;  // Salva o ID do cliente na sessão
                header("Location: index.php");  // Redireciona para a página inicial
                exit();
            } else {
                return "Senha incorreta!";
            }
        } else {
            return "E-mail não encontrado!";
        }
    }

    // Chamando a função de login
    $login_result = login_cliente($email, $password);

    if ($login_result !== true) {
        echo "<p>$login_result</p>";  // Exibe mensagem de erro caso haja
    }
}
?>
