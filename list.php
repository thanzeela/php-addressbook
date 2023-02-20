<!DOCTYPE html>
<html>

<head>



  <style>
    /* Add CSS styles for the navbar */
    .navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: black;
      padding: 0.5rem;
      /* color: black; */
      font-size: 1.0rem;
      flex-direction: row;
      margin: -10px;
    }

    body {
      
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: 100vw 100vh;
    }

    .mail {
      display: flex;
      margin-left: 350px;
      font-size: 20px;
      color: red;
    }

    /* .navbar p {
      display: flex;
      justify-content: center;
    } */

    .navbar a {
      /* color: red; */
      text-decoration: none;
      /* margin-left: 100px; */
      padding: 10px;

    }

    .navbar h1 {
      margin-left: 450px;
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
      width: 90%;

      margin-top: -90px;
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
      padding: 20px 15px;
      background-color: white;
      color: black;
      border-style: hidden;
      border-radius: 5px;
      font-size: 1.2rem;
      cursor: pointer;
      margin: 5.5px;
      height: 45px;
      margin-left: 5px;



    }

    .container {
      max-width: 960px;
      margin: 0 auto;
      text-align: center;
      padding: 50px 0;
      font-size: 1.5em;
      /* background-image:  url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_F8Wwa4Yq_gEIA-nPNTfrhJ_dtnvCoHfdTg&usqp=CAU");
      background-repeat: no-repeat; */

    }

    #id2 {
      margin-top: 5px;
    }

    #welcome {
      align-items: center;
      justify-content: center;
    }

    #add_user {
      padding: 10px 15px;
      background-color: white;
      color: red;
      border-style: hidden;
      border-radius: 5px;
      font-size: 1.2rem;
      cursor: pointer;

      height: 45px;
      margin: 5.5px;
      margin-left: 1000px;
    }

    .con p {
      font-family:Calligraphy ;
      font-size: 50px;
      line-height: 1.5;
      margin-top: 130px;
    }


    /* Add styles for the address table */


    #address_table {
      display: none;
      margin: 10px;

    }

    /* .myStyle{
  width:100%;
} */
  </style>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['email'])) {


    header("Location: login.php");
  }
  if (isset($_GET['logout'])) {

    session_destroy();
    header("Location: login.php");
  }


  ?>
  <div class="navbar">

    <h1 style="color:white;">Address Book</h1>
    <div class="mail">
      <p><?php echo $_SESSION['email'] ?></p>
      <a href="list.php?logout=true" style="color:white;margin-top:10px; ">Logout</a>
    </div>

  </div>
  <!-- Show Address button -->
  <div id="id2" style="display: flex;flex-direction: row;">
    <button id="add_user"><a href="add.php" style="color:black;"> AddUser</a></button>
    <button id="show_address">ShowAddress</button>
  </div>
  <div class="container">



    <p style="color:white"> Details on my Address Book.</p>

    <div>
      <!-- Address table -->
      <table id="address_table">
        <tr>
          <th style="color:black">Name</th>
          <th style="color:black">Phone</th>
          <th style="color:black">State</th>
          <th style="color:black">Country</th>
          <th style="color:black">Photo</th>
          <th style="color:black">Pincode</th>
          <th style="color:black">Edit</th>
          <th style="color:black">Delete</th>
        </tr>


        <?php


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

        if ($result->num_rows > 0) {

          $row = $result->fetch_assoc();
          $id = $row["id"];
        } else {
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
            echo "<td><img src='images/" . $row["photo"] . "' height='50' width='50' style='border-radius:50px'></td>";
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
    </div>

    <script>
      document.getElementById("show_address").addEventListener("click", function() {
        document.getElementById("address_table").style.display = "inline-table"
        // document.getElementById("address_table").classList.add("myStyle");

      });
    </script>

<div class="con">
    
    
    <p style="color:black"><b>MANAGE  CONTACTS<br>
AND GROUP THEM IN
VARIOUS CATEGORIES..<br><b> </p>
  </div>
</body>

</html>