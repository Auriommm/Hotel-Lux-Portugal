<?php
session_start();
require_once 'config.php';// Arquivo de conexão ao banco de dados
?>

<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $cliente_id = $_POST['cliente_idcliente'];
    $quarto_id = $_POST['quarto_idquarto'];
    $data_checkin = $_POST['data_checkin'];
    $data_checkout = $_POST['data_checkout'];

    // Valida as datas
    if (empty($cliente_id) || empty($quarto_id) || empty($data_checkin) || empty($data_checkout)) {
        $_SESSION['erro'] = "Todos os campos devem ser preenchidos.";
        header("Location: reservar.php");
        exit();
    }

    // Converte as datas para formato adequado
    $data_checkin = date('Y-m-d', strtotime($data_checkin));
    $data_checkout = date('Y-m-d', strtotime($data_checkout));

    if ($data_checkin >= $data_checkout) {
        $_SESSION['erro'] = "A data de check-out deve ser posterior à data de check-in.";
        header("Location: reservar.php");
        exit();
    }

    // Verifica a disponibilidade do quarto
    $query = "SELECT * FROM reserva WHERE quarto_idquarto = ? AND status = 'Ativa' AND 
              (data_checkin BETWEEN ? AND ? OR data_checkout BETWEEN ? AND ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $quarto_id, $data_checkin, $data_checkout, $data_checkin, $data_checkout);
    $stmt->execute();
    $stmt->store_result();

    // Se houver uma reserva no período, o quarto está indisponível
    if ($stmt->num_rows > 0) {
        $_SESSION['erro'] = "O quarto já está reservado para as datas escolhidas.";
        header("Location: reservar.php");
        exit();
    }

    // Insere a reserva no banco de dados
    $query = "INSERT INTO reserva (cliente_idcliente, quarto_idquarto, data_checkin, data_checkout, status) 
              VALUES (?, ?, ?, ?, 'Ativa')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $cliente_id, $quarto_id, $data_checkin, $data_checkout);

    if ($stmt->execute()) {
        // Atualiza o status do quarto para 'Reservado'
        $query = "UPDATE quarto SET status = 'Reservado' WHERE idreserva = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $quarto_id);
        $stmt->execute();

        $_SESSION['sucesso'] = "Reserva realizada com sucesso!";
        header("Location: reservas.php");
    } else {
        $_SESSION['erro'] = "Erro ao realizar a reserva.";
        header("Location: reservar.php");
    }
    exit();
}
?>