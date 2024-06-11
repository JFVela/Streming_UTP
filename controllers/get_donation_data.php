<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}


// Monto total obtenido de las sonaciones
$query_liquidez = "SELECT SUM(monto) AS liquidez_total FROM donación";
$result_liquidez = mysqli_query($conexion, $query_liquidez);
$row_liquidez = mysqli_fetch_assoc($result_liquidez);
$liquidez_total = $row_liquidez['liquidez_total'];

// Total de participante sin contar que a los donantes repetidos
$query_participantes = "SELECT COUNT(DISTINCT id_Usuarios) AS total_participantes FROM donación";
$result_participantes = mysqli_query($conexion, $query_participantes);
$row_participantes = mysqli_fetch_assoc($result_participantes);
$total_participantes = $row_participantes['total_participantes'];

// Total de donaciones que se han realizado
$query_donaciones = "SELECT COUNT(id_Usuarios) AS total_donaciones FROM donación";
$result_donaciones = mysqli_query($conexion, $query_donaciones);
$row_donaciones = mysqli_fetch_assoc($result_donaciones);
$total_donaciones = $row_donaciones['total_donaciones'];

// Promedio de dinero total de las donaciones por el total de donaciones
$promedioDonaciones = ($liquidez_total / $total_donaciones);

// Monto total de la campaña Educación
$SQL_Edu= "SELECT SUM(monto) AS Monto_Edu FROM donación where campaña = 'Educación'";
$resultado_Edu = mysqli_query($conexion,$SQL_Edu); 
$row_Edu =mysqli_fetch_assoc($resultado_Edu);
$Monto_Edu = $row_Edu['Monto_Edu'];

// Monto total de la campaña Salud
$SQL_Sal= "SELECT SUM(monto) AS Monto_Sal FROM donación where campaña = 'Salud'";
$resultado_Sal = mysqli_query($conexion,$SQL_Sal); 
$row_Sal =mysqli_fetch_assoc($resultado_Sal);
$Monto_Sal = $row_Sal['Monto_Sal'];

// Monto total de la campaña Alimentación
$SQL_Ali ="SELECT SUM(monto) AS Monto_Ali FROM donación where campaña = 'Alimentación'";
$resultado_Ali = mysqli_query($conexion,$SQL_Ali); 
$row_Ali =mysqli_fetch_assoc($resultado_Ali);
$Monto_Ali = $row_Ali['Monto_Ali'];

// Monto total de la campaña Vivienda
$SQL_Viv= "SELECT SUM(monto) AS Monto_Viv FROM donación where campaña = 'Vivienda'";
$resultado_Viv = mysqli_query($conexion,$SQL_Viv); 
$row_Viv =mysqli_fetch_assoc($resultado_Viv);
$Monto_Viv = $row_Viv['Monto_Viv'];

// Conertidor de formatos
function formatNumber($num) {
    if($num > 999 && $num <= 999999) {
        return number_format($num/1000, 1) . 'k';
    } else if($num > 999999) {
        return number_format($num/1000000, 2) . 'M';
    } else {
        return number_format($num, 2);
    }
}

// Vuelve los datos numericos a otros que faciliten su comprensión
$liquidez_total = formatNumber($liquidez_total);
$total_participantes = formatNumber($total_participantes);
$total_donaciones = formatNumber($total_donaciones);
$promedioDonaciones = formatNumber($promedioDonaciones);
$Monto_Edu = formatNumber($Monto_Edu);
$Monto_Sal = formatNumber($Monto_Sal);
$Monto_Ali = formatNumber($Monto_Ali);
$Monto_Viv = formatNumber($Monto_Viv);

// Devolver los datos en formato JSON
echo json_encode(array(
    'liquidez_total' => $liquidez_total,
    'total_participantes' => $total_participantes,
    'total_donaciones' => $total_donaciones,
    'promedioDonaciones' => $promedioDonaciones,
    'jsonEdu' => $Monto_Edu,
    'jsonSal' => $Monto_Sal,
    'jsonAli' => $Monto_Ali,
    'jsonViv' => $Monto_Viv,
));

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
