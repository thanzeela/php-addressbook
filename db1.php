<?php
$servername = "localhost";
$username = "root";
$password = "Thanzi@2001";
$dbname = "addressbook";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create user table
$user_table = "CREATE TABLE user (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  mobile VARCHAR(15) NOT NULL,
  password VARCHAR(50) NOT NULL,
  address VARCHAR(50) NOT NULL
)";

if (mysqli_query($conn, $user_table)) {
    echo "User table created successfully";
} else {
    echo "Error creating user table: " . mysqli_error($conn);
}

// Create addressbook table
$addressbook_table = "CREATE TABLE address (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  phone VARCHAR(15) NOT NULL,
  state VARCHAR(30) NOT NULL,

  country VARCHAR(30) NOT NULL,
  photo VARCHAR(30) NOT NULL,
  pincode INT(10) NOT NULL,


  
  
  user_id INT(6) UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(id)
)";

if (mysqli_query($conn, $addressbook_table)) {
    echo "Addressbook table created successfully";
} else {
    echo "Error creating addressbook table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
