<!DOCTYPE html>
<html>
<head>
  <title>Address Book - Login</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    header {
      /* background-color: cyan; */
      color: white;
      padding: 10px;
      text-align: center;
     
    }

    header h1 {
      margin: 0;
   
    }

    .container {
      max-width: 960px;
      margin: 50px auto;
      text-align: center;
      padding: 50px;
      /* background-color: cyan; */
      color: black;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
    }

    form {
      width: 50%;
      margin: 0 auto;
      text-align: left;
      padding: 50px;
    }
    nav {
      background-color: black;
      justify-content: center;
      align-items: center;
      display: flex;
      font-family: Times New Roman;
      /* justify-content: flex-end; */
      padding: 10px;
      
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: black;
      color: white;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    .links {
      text-align: center;
      margin-top: 20px;
    }

    .links a {
      color: navy;
      text-decoration: none;
    }

    .links a:hover {
      color: #555;
    }
  </style>
</head>
<body>
  <header>
    <nav>
    <h1>WELCOME TO BT ADDRESS BOOK</h1>
  </nav>
  </header>
  <div class="container">
    <h2>Login</h2>
    <form action="" method="post">
    <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name = "submit" value="Submit">
    </form>
    <div class="links">
      <p>Don't have a account yet? <a href="register.php"> Register here</a><p>
      <a href="index.php">Back to Home🏡</a>
    </div>
  </div>
</body>
</html>


<?php


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


$email = '';
$password = '';


//store in session
session_start();

if (isset($_POST['submit']))
{

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) 
    {
        
        header("Location: list.php");

        exit;
    } 
    else 
    {
        echo "Email or password is incorrect. Please try again.";
    }


    mysqli_close($conn);




    

}


?>
