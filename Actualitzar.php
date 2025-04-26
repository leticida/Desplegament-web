<?php

// Inclou l'arxiu de connexió
require_once('Connexio.php');

/**
 * Classe Actualitzar
 * 
 * Gestiona l'actualització d'un producte existent a la base de dades.
 */
class Actualitzar {

    /**
     * Actualitza un producte amb els valors proporcionats.
     *
     * @param int|string $id ID del producte.
     * @param string $nom Nom del producte.
     * @param string $descripcio Descripció del producte.
     * @param float|string $preu Preu del producte.
     * @param int|string $categoria ID de la categoria del producte.
     * 
     * @return void
     */
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        // Verifica que tots els camps requerits estiguin presents
        if (!isset($id, $nom, $descripcio, $preu, $categoria)) {
            echo '<p>Es requereixen tots els camps per actualitzar el producte.</p>';
            return;
        }

        // Crea una instància de connexió
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Utilitza consulta preparada per evitar SQL Injection
        $consulta = "UPDATE productes 
                     SET nom = ?, descripció = ?, preu = ?, categoria_id = ? 
                     WHERE id = ?";
        $stmt = $conexion->prepare($consulta);
        
        if (!$stmt) {
            echo '<p>Error en preparar la consulta: ' . $conexion->error . '</p>';
            return;
        }

        // Lliga els paràmetres: ssdi = string, string, double, integer
        $stmt->bind_param("ssdii", $nom, $descripcio, $preu, $categoria, $id);

        if ($stmt->execute()) {
            header('Location: Principal.php');
            exit();
        } else {
            echo '<p>Error en actualitzar el producte: ' . $stmt->error . '</p>';
        }

        // Tanca la connexió
        $stmt->close();
        $conexion->close();
    }
}

// Obté els valors del formulari
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

// Crea una instància de la classe i actualitza el producte
$actualitzarProducte = new Actualitzar();
$actualitzarProducte->actualizar($id, $nom, $descripcio, $preu, $categoria);

?>
