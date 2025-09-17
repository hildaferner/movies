<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get search query from GET, GET retrieves data from the server 
$search = trim($_GET['search'] ?? '');

// Prepare SQL
//to search for movies in the table 
if ($search !== '') {
    // Use LIKE for partial matches
    $stmt = $link->prepare("SELECT * FROM movies WHERE mname LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch);
} else {
    $stmt = $link->prepare("SELECT * FROM movies");
}
//Execute the query and fetch the result  
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style_show.css">
    <title>Movies List</title>
   
</head>
<body>
    <h2>Movies</h2>

    <!-- Sends the users search term using get,when the user clicks on search, the browser will reload and ?search= appears in the url -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by movie name" value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="Search">
          <!--if not empty will run a filtered query using like to find partial mathces, if empty default show all movies  -->
        <?php if ($search !== ''): ?>
            <a href="showmovies.php">Clear</a>
        <?php endif; ?>
    </form>

    <br>

    <table >
        <tr>
            <th>mid</th>
            <th>mname</th>
            <th>myear</th>
            <th>mgenreid</th>
            <th>mrating</th>
        </tr>
      
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['mid'] ?></td>
                    <td><?= htmlspecialchars($row['mname']) ?></td> <!--specialchars Å;Ä;Ö-->
                    <td><?= $row['myear'] ?></td>
                    <td><?= $row['mgenreid'] ?></td>
                    <td><?= $row['mrating'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No results found</td></tr>
        <?php endif; ?>
    </table>
    <a href='insert.php'>Add another movie</a><br>
</body>
</html>
