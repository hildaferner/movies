<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get search query from form
$search = trim($_GET['search'] ?? '');

// Prepare SQL
if ($search !== '') {
    // Use LIKE for partial matches
    $stmt = $link->prepare("SELECT * FROM movies WHERE mname LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch);
} else {
    $stmt = $link->prepare("SELECT * FROM movies");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styling.css">
    <title>Movies List</title>
   
</head>
<body>
    <link rel="stylesheet" href="styling.css">
    <h2>Movies</h2>

    <!-- Search form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by movie name" value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="Search">
        <?php if ($search !== ''): ?>
            <a href="showmovies.php">Clear</a>
        <?php endif; ?>
    </form>

    <br>

    <table border="1" cellpadding="5" cellspacing="0">
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
                    <td><?= htmlspecialchars($row['mname']) ?></td>
                    <td><?= $row['myear'] ?></td>
                    <td><?= $row['mgenreid'] ?></td>
                    <td><?= $row['mrating'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No results found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
