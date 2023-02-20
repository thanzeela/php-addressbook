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

$photo = $_FILES["photo"]["name"];


$pincode = $_POST["pincode"];

$target_dir = "images/";
 $target_file = $target_dir . basename($_FILES["photo"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $extensions_arr = array("jpg", "jpeg", "png", "gif");
   move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);




if (!preg_match("/^[a-zA-Z]+$/", $name)) {
  $name_error = "Name must contain only letters";
  $is_valid = false;
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
  $phone_error = "Mobile  contain 10 digits";
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

  echo '<script>alert("Added new contact successfully ");
   location.href = "list.php";
    </script>';
  
  
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

    <form action="" method = "post"  enctype="multipart/form-data">
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


      <label for="photo" style="color: red">Upload Photo:</label>
       <input type="file" id="photo" name="photo" onchange="previewImage(event);">
        <img id="preview" style="max-width : 100px; "><br><br>
      

      <label for="pincode">Pincode:</label>
      <input type="number" id="pincode" name="pincode">
      <span class="error"><?php echo $pincode_error; ?></span><br><br>


      <input type="submit" name = "submit" value="Submit">
      <a href = "list.php">Go back</a>

    </form>



    <script>
     function previewImage(event) {
       var reader = new FileReader();
       reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
         }
          reader.readAsDataURL(event.target.files[0]);
           }
            </script>
    </div>
  </body>
</html>
