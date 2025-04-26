<?php

require_once('Connexio.php');
require_once('Header.php');

class Modificar {

    // Método para mostrar el formulario de modificación del producte$producte
    public function mostrarFormulari($id) {
        // Verifica si el ID del producte$producte es válido
        if (!isset($id) || !is_numeric($id)) {
            echo '<p>ID de producte$producte no válido.</p>';
            return;
        }

        // Obtiene la conexión a la base de datos
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta para obtener la información del producte$producte
        $consulta = "SELECT id, nom, descripció, preu, categoria_id
                     FROM productes
                     WHERE id = " . $id;
        $resultat = $conexion->query($consulta);

        // Verifica si se encontró el producte$producte
        if ($resultat && $resultat->num_rows > 0) {
            $producte = $resultat->fetch_assoc();

            // Imprime la estructura HTML del formulario de modificación
            echo '<!DOCTYPE html>
                  <html lang="cat">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>Modificar producte</h2>
                        <hr>
                        <form action="Actualitzar.php" method="POST">
                            <!-- Campos del formulario con la información actual del producte$producte -->
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
                                    <!-- Opciones del selector de categorías con la opción seleccionada según la información actual -->
                                    <option value="1" ' . ($producte['categoria_id'] == 1 ? 'selected' : '') . '>Electrònics</option>
                                    <option value="2" ' . ($producte['categoria_id'] == 2 ? 'selected' : '') . '>Roba</option>
                                    <!-- Agrega más opciones según sea necesario -->
                                </select>
                            </div>

                            <!-- Agrega más campos según sea necesario -->

                            <hr>
                            <!-- Botones de guardar y cancelar -->
                            <input type="submit" value="Desar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>';
            
            // Incluye el pie de página
            require_once('Footer.php');
        } else {
            echo '<p>No hem trobat el producte$producte.</p>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}

// Obtiene el ID del producte$producte de la variable GET
$idProducto = isset($_GET['id']) ? $_GET['id'] : null;

// Crea una instancia de la clase Modificar y llama al método mostrarFormulari
$modificarProducto = new Modificar();
$modificarProducto->mostrarFormulari($idProducto);

?>
