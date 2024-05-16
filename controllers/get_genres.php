<?php
include "../config/conexion.php"; // Asegúrate de que la ruta es correcta

$sql = "SELECT nomb_genero FROM cineandes.genero";
$result = $conn->query($sql);

$genres = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row['nomb_genero']; // Asegúrate de usar el nombre correcto del campo
    }
}

// Mostrar la lista de géneros
echo "<ul>";
foreach ($genres as $genre) {
    echo "<li>" . htmlspecialchars($genre) . "</li>";
}
echo "</ul>";

$conn->close();
?>
