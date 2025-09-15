<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

// SQL to create tables
$sql = "
CREATE TABLE IF NOT EXISTS genres (
    gid INT AUTO_INCREMENT PRIMARY KEY,
    mgenre VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS movies (
    mid INT AUTO_INCREMENT PRIMARY KEY,
    mname VARCHAR(100) NOT NULL,
    myear YEAR NOT NULL,
    mgenreid INT,
    mrating INT CHECK (mrating BETWEEN 1 AND 5),
    FOREIGN KEY (mgenreid) REFERENCES genres(gid)
);
";

// Run multi-query (because we have 2 CREATE TABLEs)
if ($link->multi_query($sql) === TRUE) {
    echo "Tables created successfully!";
} else {
    echo "Error creating tables: " . $link->error;
}

// Add some sample genres (optional)
$genres = ["Action", "Comedy", "Drama", "Sci-Fi", "Horror"];
foreach ($genres as $genre) {
    $stmt = $link->prepare("INSERT INTO genres (mgenre) VALUES (?)");
    $stmt->bind_param("s", $genre);
    $stmt->execute();
}

echo "<br>Sample genres added!";
?>
