<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Pegawai.php';

$database = new Database();
$db = $database->getConnection();

$pegawai = new Pegawai($db);
$pegawai = $pegawai->readAll();
?>

<?php include 'views/header.php'; ?>

<h2>Pegawai</h2>
<a href="add_pegawai.php" class="btn btn-primary">Tambah Data</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Tanggal Bergabung</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $pegawai->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['jabatan']; ?></td>
            <td><?php echo $row['tanggal_bergabung']; ?></td>
            <td>
                <a href="edit_pegawai.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="delete_pegawai.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>