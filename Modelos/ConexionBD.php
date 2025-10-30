    <?php

    class ConexionBD {

        // Definir el método cBD() como estático
        public static function cBD() {

            try {
                // Crear la conexión PDO
                $bd = new PDO("mysql:host=localhost;dbname=reservas_db", "root", "");

                // Configurar UTF-8
                $bd->exec("set names utf8");

                return $bd; // Devolver la conexión
            } catch (PDOException $e) {
                // Manejar errores de conexión
                die("Error: " . $e->getMessage());
            }
        }
    }


