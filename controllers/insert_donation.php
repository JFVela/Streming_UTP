<?php
include '../config/conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioId = $_POST['user_id'];
    $transaction_id = $_POST['idTransaccion'];
    $estado = $_POST['estado'];
    $amount = $_POST['amount'];
    $campaign = $_POST['campaign'];

    $stmt = $conexion->prepare("INSERT INTO cineandes.donación (id_Usuarios, id_Transaccion, estado, monto, campaña, fecha) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("issss", $usuarioId, $transaction_id, $estado, $amount, $campaign);
    

    if ($stmt->execute()) {
        echo "Donación registrada con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
