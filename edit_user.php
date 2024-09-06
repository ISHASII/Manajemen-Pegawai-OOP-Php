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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->id = $_POST['id'];
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    
    if ($user->update()) {
        header("Location: users.php");
        exit();
    } else {
        $error = "Update failed.";
    }
} else {
    $user->id = $_GET['id'];
    $stmt = $user->readAll();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include 'views/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Edit User</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="edit_user.php">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user_data['username']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user_data['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>

<?php include 'views/footer.php'; ?>
