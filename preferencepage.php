<?php
  session_start();
  include_once 'connect.php'; //to include the file to connect to the database

?>

<!DOCTYPE html>
<html>
<head><title> Preferences </title>

  <link rel = "stylesheet" type="text/css" href = "preferencepage.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">

</head>

<body>
  <?php
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_SESSION['origin'] = $_POST["origin"];
        $_SESSION["destination"] = $_POST["destination"];
        $_SESSION["depart_date"] = $_POST["depart_date"];
        $_SESSION["return_date"] = $_POST["return_date"];
      }
  ?>

  <?php
    $object = new dbconn;
    $object->connect();
   ?>

  <header>
    <h1 id="prefpageslogan">FlyEasy</h1>
  </header>

  <div id="preferences" class = "display">
    <h2> Please enter in your flight details </h2> <br/>
    <form id="frm" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      Origin City
      <select name="origin">
        <option value="atlanta"> Atlanta </option>
        <option value = "nyc"> New York City </option>
        <option value="chicago"> Chicago </option>
        <option value="boston"> Boston </option>
      </select>
      Destination City
      <select  name="destination">
        <option value = "nyc"> New York City </option>
        <option value="atlanta"> Atlanta </option>
        <option value="chicago"> Chicago </option>
        <option value="boston"> Boston </option>
      </select>
      <br/> <br/>
      Departing <input name="depart_date" type="textfield" value="MM/DD">
      Returning <input name= "return_date" type="textfield" value="MM/DD">
      <br/><br/>
      <button type="submit" class="submitbutton" id="button" >
          Save input
      </button>
    </form>
    <br/> <br/>
    <a href="bookingpage.php" id="link">
    <button type="submit" class="submitbutton" id="findflights" >
        Find flights
    </button>
    </a>

  </div>


</body>
</html>
