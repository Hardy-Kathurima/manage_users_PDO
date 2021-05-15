<?php 
require 'connection.php';



if (array_key_exists('id', $_GET)) {
  $id = htmlspecialchars($_GET['id']);
}


	
$select = 'SELECT * FROM users WHERE id=:id ';
$stmt = $conn->prepare($select);
$stmt->execute([':id'=>$id]);
$user = $stmt->fetch(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){
	$edit_user = htmlspecialchars($_POST['edit_user']);
	$username= htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);

	if(!empty($username) && !empty($email)){
	$update = 'UPDATE users SET username=:username, email=:email WHERE id=:id';
	$stmt=$conn->prepare($update);
	if($stmt->execute([':username'=>$username,':email'=>$email,':id'=>$edit_user])){
		header('Location:index.php');
	}

}
}





 ?>

 <?php include_once 'templates/header.php'; ?>

 <div class="container">

 	<div class="card mt-5 w-50 mx-auto">
 	
 		<div class="card-header">
 			<h2>Edit user Details</h2>
 			
 		</div>

 		<div class="card-body">
 			<form action="edit.php" method="POST">
 				<input type="hidden" name="edit_user" value="<?php echo $user->id; ?>">
 				<div class="form-group">
 					<label for="username">Username</label>
 					<input class="form-control" type="text" name="username" id="username" value="<?php echo $user->username; ?>" required>
 				</div>
 				<div class="form-group">
 					<label for="email">Email</label>
 					<input class="form-control" type="email" name="email" id="email" value="<?php echo $user->email ?>" required>
 				</div>

 				<div class="form-group">
 					<button class="btn btn-info" type="submit" name="submit">Submit</button>
 				</div>


 			</form>
 			
 		</div>
 	</div>
 	

 </div>

 <?php include_once 'templates/footer.php'; ?>