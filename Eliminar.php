<?php
require_once('Connexio.php');

class Eliminar {

    public function eliminarProducte($id) {
        // Comprovar que l'ID sigui vàlid
        if (!isset($id) || empty($id)) {
            echo '<p>ID de producte no vàlid.</p>';
            return;
        }

        // Connexió a la base de dades
        $connexioObj = new Connexio();
        $connexio = $connexioObj->obtenirConnexio();

        // Consulta per eliminar el producte
        $consulta = "DELETE FROM productes WHERE id = ?";
        $stmt = $connexio->prepare($consulta);
        $stmt->bind_param("s", $id); // "s" per a string (no "i" com a integer)

        if ($stmt->execute()) {
            // Redirigir a Principal.php si l'eliminació té èxit
            header("Location: Principal.php");
            exit();
        } else {
            echo '<p>Error en eliminar el producte.</p>';
        }

        // Tancar connexions
        $stmt->close();
        $connexio->close();
    }
}

// Obtenir l'ID del producte des de la URL (GET)
$idProducte = isset($_GET['id']) ? $_GET['id'] : null;

// Crear instància i cridar la funció
$eliminarProducte = new Eliminar();
$eliminarProducte->eliminarProducte($idProducte);

?>
