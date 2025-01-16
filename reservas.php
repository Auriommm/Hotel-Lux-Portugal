<?php
session_start();
require_once 'config.php';
?>

<h1>Minhas Reservas</h1>
<table>
    <thead>
        <tr>
            <th>Quarto</th>
            <th>Data de Check-in</th>
            <th>Data de Check-out</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cliente_id = $_SESSION['cliente_id'];
        $query = "SELECT reserva.idreserva, quarto.numero_quarto, reserva.data_checkin, reserva.data_checkout, reserva.status 
                  FROM reserva 
                  JOIN quarto ON reserva.quarto_idquarto = quarto.idquarto 
                  WHERE reserva.cliente_idcliente = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($reserva_id, $numero_quarto, $data_checkin, $data_checkout, $status);

        while ($stmt->fetch()) {
            echo "<tr><td>{$numero_quarto}</td><td>{$data_checkin}</td><td>{$data_checkout}</td><td>{$status}</td></tr>";
        }
        ?>
    </tbody>
</table>