<?php

/**
 * Classe Connexio
 * 
 * Gestiona la connexió amb la base de dades 'la_meva_botiga'.
 */
class Connexio {
    // Dades de la connexió a la base de dades
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $baseDatos = "la_meva_botiga";

    /**
     * Obté una connexió activa a la base de dades.
     *
     * @return mysqli Objecte de connexió a la base de dades.
     */
    public function obtenirConnexio() {
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        if ($conexion->connect_error) {
            die("Error de connexió: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>
