<?php
require 'connection.php';
$username = '';
$email = '';
$message = '';

if (isset($_POST['submit'])) {
	if (!empty($_POST['username']) && !empty($_POST['email'])) {
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$insert = 'INSERT INTO users(username,email) VALUES(:username,:email)';
		$stmt = $conn->prepare($insert);
		if (!$stmt->execute([':username' => $username, ':email' => $email])) {
			$message = '<div class="alert alert-danger m-2"> email already exists </div>';
		} else {
			$message = '<div class="alert alert-success m-2"> Data successfully inserted </div>';
			$username = '';
			$email = '';
		}
	}
}
?>

<?php include_once 'templates/header.php'; ?>
<nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <a class="navbar-brand text-dark " href="index.php">~~HOME~~</a>
    <ul class="navbar-nav">
    </ul>
</nav>
<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <?php if (!empty($message)) : ?>
        <?php echo $message; ?>
        <?php endif; ?>
        <div class="card-header bg-info text-white">
            <h2 class="text-center">Add a user</h2>
        </div>
        <div class="card-body">
            <form action="add.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username"
                        value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>"
                        required>
                </div>

                <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once 'templates/footer.php'; ?>