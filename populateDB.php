<?php
//Enable errror reporting 
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Connect to database 
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

// Execute both CREATE TABLE statements 
if ($link->multi_query($sql) === TRUE) {
    echo "Tables created successfully!";
} else {
    echo "Error creating tables: " . $link->error;
}

// Insert sample genres, the scroll down meny wont work if we dont add genres first 

$genres = ["Action", "Comedy", "Drama", "Sci-Fi", "Horror"];
foreach ($genres as $genre) {
    $sql = "INSERT INTO genres (mgenre) VALUES ('$genre')";
    $link->query($sql);
}

echo "<br>Sample genres added!";
?>
