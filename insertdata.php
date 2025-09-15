<?php
// insert.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Get POST data safely
$mname    = trim($_POST['mname'] ?? '');
$myear    = intval($_POST['myear'] ?? 0);
$mgenreid = intval($_POST['mgenreid'] ?? 0);
$mrating  = intval($_POST['mrating'] ?? 0);

// Basic validation
$errors = [];
if ($mname === '') $errors[] = "Movie name is required.";
if ($myear < 1900 || $myear > 2100) $errors[] = "Year must be between 1900 and 2100.";
if ($mgenreid <= 0) $errors[] = "You must select a valid genre.";
if ($mrating < 1 || $mrating > 5) $errors[] = "Rating must be between 1 and 5.";

if (!empty($errors)) {
    echo "<h3>Errors:</h3><ul>";
    foreach ($errors as $err) {
        echo "<li>" . htmlspecialchars($err) . "</li>";
    }
    echo "</ul><a href='insert.php'>Go Back</a>";
    exit;
}

// Prepare and execute insert
$stmt = $link->prepare("INSERT INTO movies (mname, myear, mgenreid, mrating) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $link->error);
}

$stmt->bind_param("siii", $mname, $myear, $mgenreid, $mrating);

if ($stmt->execute()) {
    echo " New movie added successfully!<br>";
    echo "<a href='showmovies.php'>View Movies</a><br>";
    echo "<a href='insert.php'>Add Another Movie</a>";
} else {
    die(" Insert failed: " . $stmt->error);
}
?>

