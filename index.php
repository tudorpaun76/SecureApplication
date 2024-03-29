<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if(isset($_POST['create_post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO posts (title, content, author) VALUES (:title, :content, :username)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

if(isset($_POST['edit_post'])){
    $id = $_POST['post_id'];
    $new_content = $_POST['new_content'];

    $query = "UPDATE posts SET content=:new_content WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':new_content', $new_content);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

if(isset($_POST['delete_post'])){
    $id = $_POST['post_id'];

    $query_check_admin = "SELECT isAdmin FROM users WHERE username=:username";
    $stmt_check_admin = $db->prepare($query_check_admin);
    $stmt_check_admin->bindParam(':username', $username);
    $stmt_check_admin->execute();
    $user_info = $stmt_check_admin->fetch(PDO::FETCH_ASSOC);

}

$query = "SELECT * FROM posts WHERE author=:username";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm">
            <h1 class="mt-3">Simple Blog App</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary mt-3" href="logout.php">Logout</a>
        </div>
    </div>
    
    <h2 class="mt-2">Your Blog Posts</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['content']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-2">Create Blog Post</h2>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Content" required></textarea>
        </div>
        <button type="submit" name="create_post" class="btn btn-primary">Create Post</button>
    </form>

    <h2 class="mt-2">Edit Blog Post</h2>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" name="post_id" class="form-control" placeholder="Post ID" required>
        </div>
        <div class="form-group">
            <textarea name="new_content" class="form-control" placeholder="New Content" required></textarea>
        </div>
        <button type="submit" name="edit_post" class="btn btn-primary">Edit Post</button>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
