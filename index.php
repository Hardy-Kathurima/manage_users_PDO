<?php 
include_once 'connection.php';
$message ='';

$select = 'SELECT * FROM users ORDER BY id DESC LIMIT 5 ';

$stmt = $conn->prepare($select);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ);



 ?>

 
 	
 	<?php include_once 'templates/header.php' ?>

 	<div class="container">
 		<?php if(!empty($message)): ?>
 			<?php echo '<div class="alert alert-danger"> no records exists</div>'; ?>

 		<?php endif; ?>
 		<?php if(count($users) >0): ?>
 		<div class="card mt-5">
 			<div class="card-header">
 				<h2>Users</h2>
 			</div>
 			<div class="card-body">
 				<table class=" table table-bordered table-dark">
 					
 					<tr>
 						<th>ID</th>
 						<th>Username</th>
 						<th>Email</th>
 						<th>Action</th>
 					</tr>
 					<?php foreach($users as $user): ?>
 					<tr>
 						<td><?php echo $user->id; ?></td>
 						<td><?php echo $user->username; ?></td>
 						<td><?php echo $user->email; ?></td>
 						<td>
 							<a class="btn btn-info" href="edit.php?id=<?php echo $user->id; ?>">Edit</a>
 							<a class="btn btn-danger" href="delete.php?id=<?php  echo $user->id; ?>">Delete</a>
 							
 						</td>
 					</tr>
 				<?php endforeach; ?>
 				</table>
 				
 			</div>
 		</div>
 		<?php else: ?>
 			<?php echo $message; ?>

 		<?php endif; ?>

 	</div>


 	<?php include_once 'templates/footer.php' ;?>