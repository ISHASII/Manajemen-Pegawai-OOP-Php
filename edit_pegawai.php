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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pegawai->id = $_POST['id'];
    $pegawai->nama = $_POST['nama'];
    $pegawai->jabatan = $_POST['jabatan'];
    $pegawai->tanggal_bergabung = $_POST['tanggal_bergabung'];
    
    if ($pegawai->update()) {
        header("Location: pegawaii.php");
        exit();
    } else {
        $error = "Update failed.";
    }
} else {
    $pegawai->id = $_GET['id'];
    $stmt = $pegawai->readAll();
    $pegawai_data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include 'views/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Edit Pegawai</h2>
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="edit_pegawai.php">
            <input type="hidden" name="id" value="<?php echo $pegawai_data['id']; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $pegawai_data['nama']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="<?php echo $pegawai_data['jabatan']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label>Tanggal bergabung</label>
                <input type="date" name="tanggal_bergabung" class="form-control"
                    value="<?php echo $pegawai_data['tanggal_bergabung']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php include 'views/footer.php'; ?>