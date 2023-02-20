
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

if(isset($_GET['id'])) 
{

    

$id = $_GET['id'];
$sql = "SELECT id, name, phone, state, country, photo, pincode FROM address WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);




}



if(isset($_POST['update'])) 
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $photo = $_FILES["photo"]["name"];
    $pincode = $_POST['pincode'];

    $is_valid = true;


    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
     $extensions_arr = array("jpg", "jpeg", "png", "gif");
      move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
   

      if($photo == "")
       {
         $photo = $row['photo'];
         }
        
if (!preg_match('/^[\p{L} ]+$/u', $name)) {
   $name_error = "Name must contain only letters";
    $is_valid = false;
   }
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
       $phone_error = "Mobile must contain 10 digits";
       $is_valid = false;
      }
       if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)){
         $pincode_error = "Invalid pin code";
          $is_valid = false;
        }
         if (empty($state))
          {
            $state_error = "Address cant be empty";
             $is_valid = false;
             }
             if (empty($country))
              {
                 $country_error = "Address cant be empty";
                  $is_valid = false;
                 } if ($is_valid) {




    $sql = "UPDATE address SET name='$name', phone='$phone', state='$state', country='$country', photo='$photo', pincode='$pincode' WHERE id=$id";
    if (mysqli_query($conn, $sql))
     {

      echo '<script>alert("updated successfully ");
      location.href = "list.php";
      </script>';

    }
     else 
     {
      echo "Error updating record: " . mysqli_error($conn);
    }
}
mysqli_close($conn); 
}       

?>





<html>
  <head>
    <title>Update Record</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        /* background-color: black; */
        
      }
      nav {
        background-color:#F9F5E7 ;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        
        padding: 20px;
      }
      nav a {
        color: #f2f2f2;
        text-decoration: none;
        margin-right: 20px;
      }
      form {
        background-color: #F9F5E7;
        color:black;
        padding: 40px;
        border-radius: 10px;
     
        box-shadow: 0 0 10px #999;
        margin: 50px auto;
        width: 500px;
        text-align: center;
      }
      input[type="text"], input[type="file"] {
        padding: 10px;
        margin-bottom: 20px;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #333;
      }
      input[type="submit"] {
        background-color: #333;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #f2f2f2;
        color: #333;
      }
    </style>
  </head>
  <body>
    <nav>
      <a href="list.php" style="color:black">Profile</a>
      <a href="index.php"style="color:black">Home</a>
    </nav>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <p>Name: <input type="text" name="name"  value="<?php echo $row['name']; ?>"></p>
      <p>Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"></p>
      <p>State: <input type="text" name="state" value="<?php echo $row['state']; ?>"></p>
      <p>Country: <input type="text" name="country" value="<?php echo $row['country']; ?>"></p>
      <label for="photo" style="color: red; display:flex; justify-content:flex-start;">Photo</label>
      <input type="file" name="photo" onchange="previewImage(event);" value=""><span><?php echo $row['photo'];?></span>
      <img id = "preview" style = "max-width : 100px;"><br><br>
      <p>Pincode: <input type="text" name="pincode" value="<?php echo $row['pincode']; ?>" ></p>
      <input type="submit" name="update" value="Update">
    </form>

    <script>
    function previewImage(event)
    {
       var reader = new FileReader();
        reader.onload = function()
         {
          var output = document.getElementById('preview');
          output.src = reader.result;
           }
           reader.readAsDataURL(event.target.files[0]);
            } </script>




  </body>
</html>


