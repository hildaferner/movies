
<?php
// Frontend code 
// Fetch genres for the drop down from the database
include 'db.php';
// ->  sends the SQL command to the database 
$result = $link->query("SELECT gid, mgenre FROM genres");
if (!$result) {
    die("Error fetching genres: " . $link->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style_insert.css">
    <title>Add Movie</title>
</head>
<body>
    
    <h2>Add a New Movie</h2>
    <form action="insertdata.php" method="POST">
        <label for="mname">Name:</label>
        <input type="text" name="mname" id="mname" required><br><br>

        <label for="myear">Year:</label>
        <input type="number" name="myear" id="myear" min="1900" max="2100" required><br><br>
<!--to create a drop down meny for the genres, --select gengre-- is a place holder-->
        <label for="mgenreid">Genre:</label>
        <select name="mgenreid" id="mgenreid" required>
            <option value="">--Select Genre--</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['gid'] ?>"><?= htmlspecialchars($row['mgenre']) ?></option>
            <?php endwhile; 
            // please write a short justification for why you are using alternative syntax here. It's fine, but I don't think I used it in the workshops?>
            
        </select><br><br>

        <label for="mrating">Rating (1-5):</label>
        <input type="number" name="mrating" id="mrating" min="1" max="5" required><br><br>

        <input type="submit" value="Add Movie">
    </form>
    <a href='showmovies.php'>View Already Added Movies</a><br>
</body>

</html>

