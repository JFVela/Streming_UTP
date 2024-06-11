<?php
include "../config/conexion.php";

$response = array('nombreUsuario' => false, 'correo' => false);

if (isset($_POST['nombreUsuario']) && !empty($_POST['nombreUsuario'])) {
    $nombreUsuario = $_POST['nombreUsuario'];
    $query = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE nombreUsuario = ?");
    $query->bind_param('s', $nombreUsuario);
    $query->execute();
    $query->bind_result($count);
    $query->fetch();
    if ($count > 0) {
        $response['nombreUsuario'] = true;
    }
    $query->close();
}

if (isset($_POST['correo']) && !empty($_POST['correo'])) {
    $correo = $_POST['correo'];
    $query = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ?");
    $query->bind_param('s', $correo);
    $query->execute();
    $query->bind_result($count);
    $query->fetch();
    if ($count > 0) {
        $response['correo'] = true;
    }
    $query->close();
}

echo json_encode($response);
?>
