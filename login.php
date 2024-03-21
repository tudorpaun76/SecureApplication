<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if($row){
        $_SESSION['username'] = $username;
        if($row['isAdmin'] == 1) {
            header("Location: admin.php");
            exit; 
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Login</h1>
        
        <form method="post" action="" class="mt-3">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
        
        <?php if(isset($error)): ?>
            <p class="mt-3"><?php echo $error; ?></p>
        <?php endif; ?>

        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

