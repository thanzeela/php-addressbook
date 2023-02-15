<!DOCTYPE html>
<html>
<head>
  <title>Address Book - Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      /* background-color: #f2f2f2; */
    }

    header {
      /* background-color: black; */
      color: blue;
      padding: 25px;
      text-align: center;
    
    }

    header h1 {
      margin: 0px;
      font-family:Calligraphy ;
      font-size: 50px;
    }

    .container {
      width: 500px;
      margin-left:5vw;
      margin-top:12vh;
      text-align: center;
      padding: 10px;
     
      
      /* box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2); */
    }

    form {
      /* width: 50%;
      margin: 0 auto; */
      text-align: left;
      /* padding: 50px; */
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    textarea {
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
      background-color: red;
      color: cyan;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }
    body {
  background-image: url("https://www.ntaskmanager.com/wp-content/uploads/2022/04/address-book-software.png"  );
  background-repeat: no-repeat;

   background-size: 1850px;; 
  /* backdrop-filter: blur(10px)  */
}
  </style>
</head>
<body>

  <header>
    <h1>Register</h1>
  </header>
  


  <div class="container" >


  <form action="" method="post">
      <input type="text" name="name" placeholder="Name" required pattern="^[a-zA-Z ]+$">
      <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
      <input type="number" name="mobile" placeholder="Mobile" required pattern="^[0-9]{10}$">
      <input type="password" name="password" placeholder="Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
      <textarea name="address" placeholder="Address" required></textarea>
      <input style="background-color:#CDAB6F;color:white" type="submit" name="submit" value="Submit">
    </form>


    

<p >Already have an account? <a href="login.php">Go to login</a></p>
    <p >🏡<a href="index.php">Home</a></p>

  </div>







   
       

 

    
</body>
</html>


<?php

$servername = "localhost";
$username = "root";
$password = "Thanzi@2001";
$dbname = "addressbook";

// $name_error = "";
// $email_error = "";
// $mobile_error = "";
// $password_error = "";
// $address_error = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $address = $_POST["address"];

    $sql = "INSERT INTO user(name,email,mobile,password,address)
VALUES ('$name','$email','$mobile','$password','$address')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header('Location:login.php');

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

?>

















