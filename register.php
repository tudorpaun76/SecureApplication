<?php
include 'db.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if $_POST['isAdmin'] is set and not empty
    $isAdmin = isset($_POST['isAdmin']) && $_POST['isAdmin'] === 'yes' ? 1 : 0;

    // Insert the user into the database along with isAdmin information
    $query = "INSERT INTO users (username, password, isAdmin) VALUES (:username, :password, :isAdmin)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':isAdmin', $isAdmin);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Register</h1>
        
        <form method="post" action="" class="mt-3">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="isAdmin">Register as Admin?</label><br>
        <input type="radio" id="isAdminYes" name="isAdmin" value="yes">
        <label for="isAdminYes">Yes</label>
        <input type="radio" id="isAdminNo" name="isAdmin" value="no" checked>
        <label for="isAdminNo">No</label>
    </div>
    <button type="submit" name="register" class="btn btn-primary">Register</button>
</form>


        <p class="mt-3">Return to login <a href="login.php">Login</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

