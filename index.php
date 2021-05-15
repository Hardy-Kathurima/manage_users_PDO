<?php
require 'connection.php';
$message = '';
$select = 'SELECT * FROM users ORDER BY id DESC LIMIT 5 ';
$stmt = $conn->prepare($select);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<?php include 'templates/header.php' ?>
<nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <a class="navbar-brand text-dark " href="#">~~HOME~~</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="add.php">Add a user</a>
        </li>
    </ul>
</nav>
<div class="container">
    <?php if (!empty($message)) : ?>
    <?php echo $message; ?>
    <?php endif; ?>
    <?php if (count($users) > 0) : ?>
    <div class="card mt-5 bg-dark">
        <div class="card-header bg-info text-white">
            <h2 class="text-center">A list of all users </h2>
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td>
                        <a class="btn btn-info" href="edit.php?id=<?php echo $user->id; ?>">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"
                            href="delete.php?id=<?php echo $user->id; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php else : ?>
    <?php echo $message = "<div class='text-center mt-5 bg-danger mx-auto w-25 p-3 text-white'>
	<h3>No available users</h3>
	<a class='btn btn-info mt-3' href='add.php'>Add a user</a> </div>"; ?>

    <?php endif; ?>
</div>
<?php include 'templates/footer.php'; ?>