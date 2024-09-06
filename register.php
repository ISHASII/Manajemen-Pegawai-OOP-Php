<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->email = $_POST['email'];

    if ($user->register()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>

<?php include 'views/header.php'; ?>

<head>
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #5cb85c;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .alert-danger {
        margin-top: 10px;
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error)):?>
        <div class="alert alert-danger"><?php echo $error;?></div>
        <?php endif;?>
        <form method="post" action="register.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
<?php include 'views/footer.php'; ?>

</html>