<?php

require_once('Connexio.php');
require_once('Header.php');

/**
 * Classe Modificar
 * 
 * Classe encarregada de mostrar el formulari per modificar un producte existent.
 */
class Modificar {

    /**
     * Mostra el formulari HTML per modificar un producte.
     *
     * @param int|null $id ID del producte a modificar.
     * 
     * @return void
     */
    public function mostrarFormulari($id) {
        // Verifica si l'ID del producte és vàlid
        if (!isset($id) || !is_numeric($id)) {
            echo '<p>ID de producte no vàlid.</p>';
            return;
        }

        // Obté la connexió a la base de dades
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta per obtenir la informació del producte
        $consulta = "SELECT id, nom, descripció, preu, categoria_id
                     FROM productes
                     WHERE id = " . $id;
        $resultat = $conexion->query($consulta);

        // Verifica si s'ha trobat el producte
        if ($resultat && $resultat->num_rows > 0) {
            $producte = $resultat->fetch_assoc();

            // Estructura HTML del formulari de modificació
            echo '<!DOCTYPE html>
                  <html lang="ca">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>Modificar producte</h2>
                        <hr>
                        <form action="Actualitzar.php" method="POST">
                            <input type="hidden" name="id" value="' . $producte['id'] . '">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom del producte:</label>
                                <input type="text" name="nom" class="form-control" value="' . $producte['nom'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcio" class="form-label">Descripció detallada:</label>
                                <input type="text" name="descripcio" class="form-control" value="' . $producte['descripció'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="preu" class="form-label">Preu per unitat:</label>
                                <input type="number" name="preu" class="form-control" value="' . $producte['preu'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoria:</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="1" ' . ($producte['categoria_id'] == 1 ? 'selected' : '') . '>Electrònics</option>
                                    <option value="2" ' . ($producte['categoria_id'] == 2 ? 'selected' : '') . '>Roba</option>
                                    <!-- Afegeix més opcions si cal -->
                                </select>
                            </div>

                            <hr>
                            <input type="submit" value="Desar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancel·lar</a>
                        </form>
                    </div>';

            require_once('Footer.php');
        } else {
            echo '<p>No s\'ha trobat el producte.</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Obté l'ID del producte des de la variable GET
$idProducto = isset($_GET['id']) ? $_GET['id'] : null;

// Crea una instància de la classe Modificar i mostra el formulari
$modificarProducto = new Modificar();
$modificarProducto->mostrarFormulari($idProducto);

?>
