<!DOCTYPE html>
<html>
<head>
  <style>
    /* Add CSS styles for the navbar */
    .navbar {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 15px;
      background-color: black;
      color: white;
      font-size: 1.0rem;
    }
    .navbar p {
      display: flex;
      justify-content: center;
    }
    .navbar a {
  color: white;
  text-decoration: none;
  margin-right: 10px;
  padding: 10px;
}

/* Add styles for the button */
button {
  /* padding: 10px 15px; */
  background-color: black;
  margin: right;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  /* margin-right: 10px; */
}

/* Add styles for the table */
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: -70px;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

/* Add styles for the "Show Address" button */
#show_address {
  padding: 10px 15px;
  background-color: black;
  color: white;
  border-style: hidden;
  border-radius: 5px;
  font-size: 1.2rem;
  cursor: pointer;
  margin-bottom: 20px;
  height:45px;
  margin-left:5px;
  
  
  
}
#id2{
  margin-top:5px;
}
#welcome{
  align-items:center;
  justify-content:center;
}

#add_user {
  padding: 10px 15px;
  background-color: black;
  color: white;
  border-style: hidden;
  border-radius: 5px;
  font-size: 1.2rem;
  cursor: pointer;
  margin-bottom:100px;
  height:45px;
  margin-left:1000px;
}
/* Add styles for the address table */
#address_table {
  display: none;
  margin-bottom:20vw;
  width: 500px;
  margin-top: -70px;
  

}

</style>
</head>
<body>
  <div  class="navbar">
    <div id="welcome">
    <h1>Address Book</h1>
    </div>
  
    

    <a style="margin-left:40%" href="list.php?logout=true">Logout</a>
    
  </div>
  <!-- Show Address button -->
  <div id="id2" style="display: flex;flex-direction: row;">
  <button id="add_user"><a href="add.php" style="color:white" > AddUser</a></button>
  <button id="show_address">ShowAddress</button>
  </div>
 

  <!-- Address table -->
  <table id="address_table">
    <tr>
      <th style="color:red">Name</th>
      <th style="color:red">Phone</th>
      <th style="color:red">State</th>
      <th style="color:red">Country</th>
      <th style="color:red">Photo</th>
      <th style="color:red">Pincode</th>
      <th style="color:red">Edit</th>
      <th style="color:red">Delete</th>
    </tr>

    <?php
     session_start();
     if (!isset($_SESSION['email'])) 
    {


    header("Location: login.php");
    }
    if (isset($_GET['logout'])) 
    {

      session_destroy();
     header("Location: login.php");
     }



$email = '';
$password = '';
$id = 0;



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


$email = $_SESSION['email'];

$password = $_SESSION['password'];

$sql = "SELECT id FROM user WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
{

  $row = $result->fetch_assoc();
  $id = $row["id"];
 

}

else {
  echo "0 results";
}


$sql = "SELECT id,name, phone, state, country, photo, pincode FROM address WHERE user_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["phone"] . "</td>";
      echo "<td>" . $row["state"] . "</td>";
      echo "<td>" . $row["country"] . "</td>";
      echo "<td><img src='" . $row["photo"] . "' height='50' width='50'></td>";
      echo "<td>" . $row["pincode"] . "</td>";
      echo "<td><a href='update.php?id=" . $row['id'] . "'>Edit</a></td>";
      echo "<td><a href='delete.php?id=" . $row['id'] . "' onClick='return confirm(\"Are you sure you want to delete?\")'>Delete</a></td>";
      
      echo "</tr>";
    }
  } else {
    echo "0 results";
  }

?>

</table>

<script>
  document.getElementById("show_address").addEventListener("click", function() {
    document.getElementById("address_table").style.display = "block";
  });
</script>
</body>

</html>



