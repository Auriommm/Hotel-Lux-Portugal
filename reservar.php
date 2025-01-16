<?php
// Conexão com o banco de dados
require_once 'config.php';

session_start();
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit();
}

// Formulário para fazer a reserva
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <title>Fazer Reserva</title>
</head>
<body>
    <h1>Reservar um Quarto</h1>
    <form action="process_reservation.php" method="POST">
        <label for="quarto_id">Selecione o Quarto:</label>
        <select name="quarto_id" id="quarto_id">
        <option value="1">Quarto 1</option>
        <option value="2">Quarto 2</option>
        <option value="3">Quarto 3</option>
        <option value="4">Quarto 4</option>

            <!-- Preencha dinamicamente com os quartos disponíveis -->
        </select>
        <label for="checkin">Data de Check-in:</label>
        <input type="date" name="checkin" required>
        <label for="checkout">Data de Check-out:</label>
        <input type="date" name="checkout" required>
        <button type="submit">Confirmar Reserva</button>

    </form>
</body>
</html>
