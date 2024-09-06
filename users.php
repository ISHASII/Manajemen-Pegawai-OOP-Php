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
$users = $user->readAll();
?>

<?php include 'views/header.php'; ?>

<h2>User</h2>
<a href="register.php" class="btn btn-primary">Tambah Data</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>