<?php
session_start();
require_once 'config.php'; // Arquivo de conexão ao banco de dados

// Verificar se o cliente está logado
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit();
}

// Recuperar quartos disponíveis
$query = "SELECT id, numero_quarto, tipo, preco FROM quarto WHERE status = 'Disponível'";
$result = $conn->query($query);

// Processar reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quarto_id = $_POST['quarto_id'];
    $data_checkin = $_POST['data_checkin'];
    $data_checkout = $_POST['data_checkout'];
    $cliente_id = $_SESSION['cliente_id'];

    // Inserir a reserva no banco de dados
    $query = "INSERT INTO reserva (cliente_id, quarto_id, data_checkin, data_checkout) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $cliente_id, $quarto_id, $data_checkin, $data_checkout);

    if ($stmt->execute()) {
        // Atualizar status do quarto para 'Reservado'
        $update_query = "UPDATE quarto SET status = 'Reservado' WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $quarto_id);
        $update_stmt->execute();

        echo "Reserva realizada com sucesso!";
    } else {
        echo "Erro ao realizar a reserva.";
    }
}
?>

<!-- reservar.php -->
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Reserva</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <form id="reservation-form" method="POST" action="process_reservation.php">
        <label for="quarto">Escolha o Quarto:</label>
        <select id="quarto" name="quarto" required>
            <option value="">Selecione um quarto</option>
            <option value="1">Quarto 1</option>
            <option value="2">Quarto 2</option>
            <!-- Outros quartos disponíveis -->
        </select><br>

        <label for="checkin">Data de Check-in:</label>
        <input type="date" id="checkin" name="checkin" required><br>

        <label for="checkout">Data de Check-out:</label>
        <input type="date" id="checkout" name="checkout" required><br>

        <input type="submit" value="Fazer Reserva">
    </form>

    <script src="script.js"></script>  <!-- Incluindo o arquivo script.js para validação -->
</body>
</html>


<!--
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Reserva</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Fazer Reserva - Hotel Lux Portugal</h1>
    </header>

    <main>
        <form method="POST">
            <label for="quarto_id">Escolha um Quarto:</label>
            <select name="quarto_id" required>
                
            </select>

            <label for="data_checkin">Data de Check-in:</label>
            <input type="date" name="data_checkin" required>

            <label for="data_checkout">Data de Check-out:</label>
            <input type="date" name="data_checkout" required>

            <button type="submit" class="button">Confirmar Reserva</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Hotel Lux Portugal. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
-->