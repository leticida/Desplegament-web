<?php

require_once('Connexio.php');
require_once('Header.php');

class NouProducte {

    private $connexio;

    public function __construct() {
        $conexionObj = new Connexio();
        $this->connexio = $conexionObj->obtenirConnexio();
    }

    // Funció per mostrar el formulari
    public function mostrarFormulari() {
        // Consulta les categories
        $consulta = "SELECT id, nom FROM categories";
        $resultat = $this->connexio->query($consulta);

        echo '<!DOCTYPE html>
              <html lang="es">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Afegir Nou Producte</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
              </head>
              <body>
                <div class="container mt-5" style="margin-bottom: 100px">
                  <h2>Afegir Nou Producte</h2>
                  <form method="POST" action="Nou.php">
                    <div class="mb-3">
                      <label for="nom" class="form-label">Nom</label>
                      <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                      <label for="descripcio" class="form-label">Descripció</label>
                      <textarea class="form-control" id="descripcio" name="descripcio" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="preu" class="form-label">Preu</label>
                      <input type="number" step="0.01" class="form-control" id="preu" name="preu" required>
                    </div>
                    <div class="mb-3">
                      <label for="categoria" class="form-label">Categoria</label>
                      <select class="form-control" id="categoria" name="categoria" required>';
        
        // Mostrar opcions de categories
        if ($resultat->num_rows > 0) {
            while ($fila = $resultat->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['nom'] . '</option>';
            }
        }

        echo       '</select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="Principal.php" class="btn btn-secondary">Cancel·lar</a>
                  </form>
                </div>';
        
        require_once('Footer.php');
    }

    // Funció per afegir el producte
    public function afegirProducte($nom, $descripcio, $preu, $categoria_id) {
        $stmt = $this->connexio->prepare("INSERT INTO productes (nom, descripció, preu, categoria_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $categoria_id);

        if ($stmt->execute()) {
            header("Location: Principal.php"); // Redirigeix a la llista de productes
            exit();
        } else {
            echo "Error en guardar el producte: " . $stmt->error;
        }
    }
}

// Controlador
$nou = new NouProducte();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nou->afegirProducte($_POST['nom'], $_POST['descripcio'], $_POST['preu'], $_POST['categoria']);
} else {
    $nou->mostrarFormulari();
}

?>
