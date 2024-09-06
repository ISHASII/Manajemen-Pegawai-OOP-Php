<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Pegawai.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $pegawai = new Pegawai($db);
    $pegawai->nama = $_POST['nama'];
    $pegawai->jabatan = $_POST['jabatan'];
    $pegawai->tanggal_bergabung = $_POST['tanggal_bergabung'];

    if ($pegawai->create()) {
        header("Location: pegawaii.php");
        exit();
    } else {
        $error = "Failed to add pegawai.";
    }
}
?>

<?php include 'views/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Tambah Data Pegawai</h2>
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="add_pegawai.php">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_bergabung" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
        </form>
    </div>
</div>

<?php include 'views/footer.php'; ?>