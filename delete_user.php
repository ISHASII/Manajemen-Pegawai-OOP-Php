<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->id = $_GET['id'];

if ($user->delete()) {
    header("Location: users.php");
    exit();
} else {
    echo "Delete failed.";
}
?>
