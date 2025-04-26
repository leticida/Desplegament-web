<?php

/**
 * Classe Footer
 * 
 * Genera i mostra el peu de pàgina (footer) i carrega els scripts necessaris.
 */
class Footer {

    /**
     * Mostra el codi HTML del footer i scripts de la pàgina.
     *
     * @return void
     */
    public function mostrarFooter() {
        // HTML del peu de pàgina
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centre de Formació Professional</p>
              </div>';

        // Scripts de Bootstrap i inicialització del carrusel
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
              <script>
                  document.addEventListener("DOMContentLoaded", function () {
                      var myCarousel = new bootstrap.Carousel(document.getElementById("carrusel"), {
                          interval: 2000,
                          wrap: true
                      });
                  });
              </script>';

        // Tancament de les etiquetes HTML
        echo '</body></html>';
    }
}

// Crear instància i mostrar el footer
$footer = new Footer();
$footer->mostrarFooter();

?>
