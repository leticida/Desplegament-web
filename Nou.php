<?php
// Connexió a la base de dades
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'la_meva_botiga';

$conn = new mysqli($host, $user, $password, $db);

// Comprovem la connexió
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

// Consulta per obtenir productes
$sql = "SELECT p.nom AS producte, p.descripció, p.preu, c.nom AS categoria 
        FROM productes p
        JOIN categories c ON p.categoria_id = c.id";

$resultat = $conn->query($sql);

// Mostrem els resultats en una taula HTML
echo "<h2>Llista de productes</h2>";
if ($resultat->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Producte</th>
                <th>Descripció</th>
                <th>Preu</th>
                <th>Categoria</th>
            </tr>";
    while($fila = $resultat->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['producte']}</td>
                <td>{$fila['descripció']}</td>
                <td>{$fila['preu']} €</td>
                <td>{$fila['categoria']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hi ha productes.";
}

// Tancar connexió
$conn->close();
?>
