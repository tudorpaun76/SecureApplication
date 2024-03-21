<?php
session_start();
include 'db.php';

// Fetch all blogs
$query = "SELECT * FROM posts";
$result = $db->query($query);

if(isset($_POST['delete_post'])){
    $id = $_POST['post_id'];

    // Delete the post
    $query_delete_post = "DELETE FROM posts WHERE id = :id";
    $stmt_delete_post = $db->prepare($query_delete_post);
    $stmt_delete_post->bindParam(':id', $id);
    $stmt_delete_post->execute();

    // Redirect to prevent form resubmission
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mt-3">Admin Dashboard</h1>
            </div>
            <div class="col">
                 <a class="btn btn-primary mt-3" href="logout.php">Logout</a>
            </div>
        </div>
    
        <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_post" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
