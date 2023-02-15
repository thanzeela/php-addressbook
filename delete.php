<?php
  if(isset($_GET['id'])) 
  {

    $servername = "localhost";
    $username = "root";
    $password = "Thanzi@2001";
   $dbname = "addressbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



    $id = $_GET['id'];
    $sql = "DELETE FROM address WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
      header("Location: list.php");
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
?>
