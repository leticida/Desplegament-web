<?php
require_once('Connexio.php');

/**
 * Classe Eliminar
 * 
 * Gestiona l'eliminació d'un producte de la base de dades.
 */
class Eliminar {

    /**
     * Elimina un producte donat el seu ID.
     *
     * @param int|string $id ID del producte a eliminar.
     * 
     * @return void
     */
    public function eliminarProducte($id) {
        // Comprova que l'ID sigui vàlid
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

        // rebem l'ID hauria de tipus string
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            // Redirigir a Principal.php si l'eliminació té èxit
            header("Location: Principal.php");
            exit();
        } else {
            echo '<p>Error en eliminar el producte: ' . $stmt->error . '</p>';
        }

        // Tancar connexions
        $stmt->close();
        $connexio->close();
    }
}

// Obtenir l'ID del producte des de la URL (GET)
$idProducte = isset($_GET['id']) ? $_GET['id'] : null;

// Crear instància de la classe Eliminar i cridar la funció eliminarProducte
$eliminarProducte = new Eliminar();
$eliminarProducte->eliminarProducte($idProducte);

?>
