<?php
include "tampilkan_data.php";
include "edit_data.php";

// Inisialisasi variabel pencarian
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $query = "SELECT id, SUBSTRING_INDEX(nama_mahasiswa, ' ', -1) AS nama_belakang, prodi FROM mahasiswa WHERE SUBSTRING_INDEX(nama_mahasiswa, ' ', -1) LIKE '%$search_term%'";
    $proses = mysqli_query($koneksi, $query);
} else {
    $query = "SELECT * FROM mahasiswa";
    $proses = mysqli_query($koneksi, $query);
}

// Inisialisasi variabel data edit
$data_edit = array(
    'id' => '',
    'nama_mahasiswa' => '',
    'prodi' => ''
);

if (isset($_GET['id'])) {
    $query_edit = "SELECT * FROM mahasiswa WHERE id = " . $_GET['id'];
    $proses_ambil = mysqli_query($koneksi, $query_edit);
    $data_edit = mysqli_fetch_assoc($proses_ambil);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Prodi Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Input Data Mahasiswa
        </div>
        <div class="card-body">
            <?php if (isset($_GET['id']) && $_GET['id'] != ''): ?>
                <form action="edit_data.php?id=<?php echo $data_edit['id'] ?>&proses=1" method="POST">
            <?php else: ?>
                <form action="proses.php" method="POST">
            <?php endif; ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa:</label>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($data_edit['id']); ?>">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data_edit['nama_mahasiswa']); ?>">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi:</label>
                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?php echo htmlspecialchars($data_edit['prodi']); ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Proses</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <button type="button" class="btn btn-info" onclick="window.location.href='?';">Refresh</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header bg-secondary text-white">
            Data Mahasiswa
        </div>
        <div class="card-body">
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama belakang" value="<?php echo htmlspecialchars($search_term); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Belakang</th>
                        <th>Program Studi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_GET['search']) && $_GET['search'] != ''): ?>
                        <?php while($data = mysqli_fetch_assoc($proses)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['id']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama_belakang']); ?></td>
                            <td><?php echo htmlspecialchars($data['prodi']); ?></td>
                            <td>
                                <a href="form.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus_data.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <?php while($data = mysqli_fetch_assoc($proses)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['id']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama_mahasiswa']); ?></td>
                            <td><?php echo htmlspecialchars($data['prodi']); ?></td>
                            <td>
                                <a href="form.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus_data.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
