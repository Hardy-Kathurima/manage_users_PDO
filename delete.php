<?php 
require 'connection.php';
if (array_key_exists('id', $_GET)) {
  $id = htmlspecialchars($_GET['id']);
}
$delete = 'DELETE FROM users WHERE id=:id';
$stmt = $conn->prepare($delete);
if($stmt->execute([':id'=>$id])){
	header('location:index.php');
}