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
$pegawai->id = $_GET['id'];

if ($pegawai->delete()) {
    header("Location: books.php");
    exit();
} else {
    echo "Delete failed.";
}
?>