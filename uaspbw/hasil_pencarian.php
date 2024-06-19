<?php
include 'connect.php';

$nim = isset($_GET['npm']) ? $conn->real_escape_string($_GET['npm']) : '';
$first_name = isset($_GET['first_name']) ? $conn->real_escape_string($_GET['first_name']) : '';
$last_name = isset($_GET['last_name']) ? $conn->real_escape_string($_GET['last_name']) : '';
$program_studi = isset($_GET['prodi']) ? $conn->real_escape_string($_GET['prodi']) : '';

$query_conditions = [];

if (!empty($npm)) {
    $query_conditions[] = "npm LIKE '%$npm%'";
}
if (!empty($first_name)) {
    $query_conditions[] = "first_name LIKE '%$first_name%'";
}
if (!empty($last_name)) {
    $query_conditions[] = "last_name LIKE '%$last_name%'";
}
if (!empty($prodi)) {
    $query_conditions[] = "prodi LIKE '%$prodi%'";
}

$sql = "SELECT * FROM mahasiswa";
if (count($query_conditions) > 0) {
    $sql .= " WHERE " . implode(" OR ", $query_conditions);
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Hasil Pencarian</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>First Name</th><th>Last Name</th><th>NPM</th><th>Program Studi</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row['first_name']) . "</td><td>" . htmlspecialchars($row['last_name']) . "</td><td>" . htmlspecialchars($row['npm']) . "</td><td>" . htmlspecialchars($row['prodi']) . "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>No results found.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
