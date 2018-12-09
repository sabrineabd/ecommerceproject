<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head> <title> Booking Page </title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <link rel = "stylesheet" type="text/css" href = "bookingpage.css">

<style>
#allflights{
  width: 75%;
  margin: 0 auto;
}
</style>
</head>

<body>
  <?php
      $origin = $destination = "";
      if(isset($_SESSION["origin"])){
        $origin = $_SESSION["origin"];
      }
      if(isset($_SESSION["destination"])){
        $destination = $_SESSION["destination"];
      }
      if(isset($_SESSION["depart_date"])){
        $depart_date = $_SESSION["depart_date"];
      }
      if(isset($_SESSION["return_date"])){
        $return_date = $_SESSION["return_date"];
      }
   ?>

   <?php

       $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
       $conn = new PDO("mysql:host=localhost;dbname = flightdb", "root", "", $options);
       $sqlquery = "SELECT flight_times, flight_duration, airline
                     FROM flightdb.flightinfo
                     WHERE flight_origin = '".$origin."'
                     AND flight_destination = '".$destination."'";
       $results = $conn->query($sqlquery);
       $secondquery = "SELECT flight_times, flight_duration, airline
                     FROM flightdb.flightinfo
                     WHERE flight_origin = '".$destination."'
                     AND flight_destination = '".$origin."'";
       $secondresults = $conn->query($secondquery);
       $flights = array(125, 175, 140);

   ?>
   <?php
          if($_SERVER["REQUEST_METHOD"]=="POST"){
              if($_POST["submitbutton"] == 0){
                $price = $flights[0];
              }
              if($_POST["submitbutton"]==1){
                $price = $flights[1];
              }
              if($_POST["submitbutton"]==2){
                $price = $flights[2];
              }
              $_SESSION["price"] = $price;
          }
    ?>


  <header>
    <h1 class="slogan"><img src="plane.png" id="airplane" width="150px" height="100px">FlyEasy</h1>

  </header>


  <div class ="display">
    <div id = "allflights">
      <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <?php
            $count = 0;
            $randomPrice = "";
        while(($row = $results->fetch()) && ($row2 = $secondresults->fetch())){

          echo "<div class = 'flightdisplay' id ='display".$count."'>";
              echo "<table>";
                echo "<tr>";
                  echo "<td> <img src='".$row['airline'].".png' width='40px' height='40px'> </td>";
                  echo "<th>".$depart_date."</th>";
                  echo "<th>".strtoupper($origin)."</th>";
                  echo "<th>".$row['flight_times']."</th>";
                  echo "<th>".$row['flight_duration']."</th>";
                  echo "<th class='price'>$".$flights[$count]."</th>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td> <img src='".$row2['airline'].".png' width='40px' height='40px'> </td>";
                  echo "<th>".$return_date."</th>";
                  echo "<th>".strtoupper($destination)."</th>";
                  echo "<th>".$row2['flight_times']."</th>";
                  echo "<th>".$row2['flight_duration']."</th>";
                  echo "<td> <button type='submit' name = 'submitbutton' value='".($count++)."' class='submitbutton'>Select</button> </td>";
                echo "</tr>";
              echo "</table>";
          echo "</div>";
      }
      ?>


    </form>
    <a href="payment.php">
    <button class="submitbutton" id="paymentbutton" >Proceed to payment</button>
  </a>
    </div>


  </div>

</body>
<html>
