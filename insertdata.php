<?php
// Backend 
//Connect to database 
include 'db.php';

// Get POST data safely, POST sends data to the server 
$mname    = trim($_POST['mname'] ?? '');
$myear    = intval($_POST['myear'] ?? 0);
$mgenreid = intval($_POST['mgenreid'] ?? 0);
$mrating  = intval($_POST['mrating'] ?? 0);



//will state which error 
if (!empty($errors)) {
    echo "<h3>Errors:</h3><ul>";
    foreach ($errors as $err) {
        echo "<li>" . htmlspecialchars($err) . "</li>";
    }
    echo "</ul><a href='index.php'>Go Back</a>";
    exit;
}

// Prepare and execute insert, prepare is to make sure that the input does not damage the database 
$stmt = $link->prepare("INSERT INTO movies (mname, myear, mgenreid, mrating) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $link->error);
}

//tell what type of parameter to expect: string, integer,integer, integer 
$stmt->bind_param("siii", $mname, $myear, $mgenreid, $mrating);

//will get you to the tsble of added movies directly 
if ($stmt->execute()) {
    header("Location: showmovies.php");
    exit(); // Always call exit after header redirect
} else {
    die("Insert failed: " . $stmt->error);
}
