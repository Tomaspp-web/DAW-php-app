<?php
/**
 * Connexió a la base de dades MySQL i creació de taules.
 *
 * @package la_meva_botiga
 * @author Tomas Payeras
 * @version 1.0
 */
$conn = new mysqli('localhost', 'root', '', 'la_meva_botiga');

// Comprovació de la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

/**
 * SQL per crear les taules 'categories' i 'productes' si no existeixen.
 */
$sql = "
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

INSERT INTO categories (nom) VALUES
    ('Electrònics'),
    ('Roba');

CREATE TABLE IF NOT EXISTS productes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    descripció TEXT,
    preu DECIMAL(10, 2) NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categories(id)
);
";

if ($conn->multi_query($sql)) {
    echo "Base de dades i taules creades correctament.";
} else {
    echo "Error en crear les taules: " . $conn->error;
}


$conn->close();
?>
