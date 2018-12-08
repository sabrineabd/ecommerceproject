<?php
    session_start();

    $origin = $_SESSION["origin"];
    $destination = $_SESSION["destination"];
    // $departdate = $_SESSION["departdate"];

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

  <header>
    <h1 class="slogan">FlyEasy</h1>
  </header>


  <div class ="display">
    <div id = "allflights">
    <form>
      <?php while(($row = $results->fetch()) && ($row2 = $secondresults->fetch())){
          echo "<div class = 'flightdisplay'>";
              echo "<table>";
                echo "<tr>";
                  echo "<td> <img src='".$row['airline'].".png' width='40px' height='40px'> </td>";
                  echo "<th> date </th>";
                  echo "<th>".strtoupper($origin)."</th>";
                  echo "<th>".$row['flight_times']."</th>";
                  echo "<th>".$row['flight_duration']."</th>";
                  echo "<th class='price'>$".rand(300,700)."</th>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td> <img src='".$row2['airline'].".png' width='40px' height='40px'> </td>";
                  echo "<th> date </th>";
                  echo "<th>".strtoupper($destination)."</th>";
                  echo "<th>".$row2['flight_times']."</th>";
                  echo "<th>".$row2['flight_duration']."</th>";
                  echo "<td colspan=> <button type='submit' class='submitbutton'>Select</button> </td>";
                echo "</tr>";
              echo "</table>";
          echo "</div>";

      }
      ?>

</form>
    </div>


  </div>

</body>
<html>

