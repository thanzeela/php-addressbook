<?php

session_start();

$email = '';
$password = '';
$id = 0;
if (!isset($_SESSION['email'])) 
{


  header("Location: login.php");
}


//localhost details

$servername = "localhost";
$username = "root";
$password = "Thanzi@2001";
$dbname = "addressbook";

$name_error = "";
$phone_error = "";
$state_error = "";
$country_error = "";

$pincode_error = "";
$is_valid = true;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$email = $_SESSION['email'];

$password = $_SESSION['password'];

$sql = "SELECT id FROM user WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
} 
else
{
  echo "No matching record found.";
}





if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$name = $_POST["name"];
$phone = $_POST["phone"];
$state = $_POST["state"];
$country = $_POST["country"];

$pincode = $_POST["pincode"];


if (!preg_match("/^[a-zA-Z]+$/", $name)) {
  $name_error = "Name must contain only letters";
  $is_valid = false;
}

if (!preg_match("/^[7-9][0-9]{9}$/", $phone)) {
  $phone_error = "Mobile must start with 7, 8 or 9 and contain 10 digits";
  $is_valid = false;
}

if (!preg_match("/^[a-zA-Z]+$/", $state)) {
  $state_error = "State must contain only letters";
  $is_valid = false;
}

if (!preg_match("/^[a-zA-Z]+$/", $country)) {
  $country_error = "Country must contain only letters";
  $is_valid = false;
}


if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)){
  $pincode_error = "Invalid pin code";
  $is_valid = false;


}

// if (empty($state)) 
// {
//   $state_error = "Address cant be empty";
//   $is_valid = false;
// }
// if (empty($country)) 
// {
//   $country_error = "Address cant be empty";
//   $is_valid = false;
// }


if ($is_valid)
{


$sql = "INSERT INTO address (name, phone, state, country, photo, pincode,user_id)
VALUES ('$name', '$phone', '$state', '$country', '$photo', '$pincode','$id')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    header("Location:list.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

}

?>


<html>
  <head>
    <style>
      body {
  background-color: #F9F5E7;
  
}

   .error{color : red;} 
      form {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      input[type="text"],
      input[type="number"],
      input[type="file"] {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      input[type="submit"] {
        width: 100%;
        padding: 12px 20px;
        margin-top: 20px;
        background-color: red;
        color: cyan;
        border: none;
        border-radius: 5px;
        cursor: pointer;
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
    header {
      /* background-color: cyan; */
      color: white;
      padding: 10px;
      text-align: center;
     
    }
    .cont {
      max-width: 960px;
      margin: 50px auto;
      text-align: center;
      padding: 50px;
      /* background-color: cyan; */
      color: black;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
    }


      input[type="submit"]:hover {
        background-color: grey;
      }
    </style>
  </head>
  <body>
  <header>
    <nav>
    <h1>ADD USER</h1>
  </nav>
  </header>
  <div class="cont">

    <form action="" method = "post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
      <span class="error"><?php echo $name_error; ?></span><br><br>


      <label for="phone">Phone:</label>
      <input type="number" id="phone" name="phone">
      <span class="error"><?php echo $phone_error; ?></span><br><br>


      <label for="state">State:</label>
      <input type="text" id="state" name="state">
      <span class="error"><?php echo $state_error; ?></span><br><br>


      <label for="country">Country:</label>
      <input type="text" id="country" name="country">
      <span class="error"><?php echo $country_error; ?></span><br><br>


      <label for="photo">Upload Photo:</label>
      <input type="file" id="photo" name="photo">
      

      <label for="pincode">Pincode:</label>
      <input type="number" id="pincode" name="pincode">
      <span class="error"><?php echo $pincode_error; ?></span><br><br>


      <input type="submit" name = "submit" value="Submit">
      <a href = "list.php">Go back</a>

    </form>
    </div>
  </body>
</html>
