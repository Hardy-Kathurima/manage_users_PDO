 <?php
  try {
    $conn = new PDO('mysql:host=localhost;dbname=manage_users', 'root', '');
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // $e->getMessage();
  }
  ?>