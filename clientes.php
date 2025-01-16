<?php
session_start();
require_once 'config.php';
?>

<h1>Gestão de Clientes</h1>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Contacto</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Exemplo de consulta ao banco para obter clientes
        $query = "SELECT * FROM cliente";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['nome']}</td><td>{$row['email']}</td><td>{$row['contacto']}</td><td><a href='editar_cliente.php?id={$row['idcliente']}'>Editar</a> | <a href='excluir_cliente.php?id={$row['idcliente']}'>Excluir</a></td></tr>";
        }
        ?>
    </tbody>
</table>