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

    while($row = $results->fetch()){
      echo $row['flight_times'];
    }

    while($row2 = $secondresults->fetch()){
      echo $row2['flight_times'];
    }


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
      <div class = "flightdisplay">
          <table>
      
            <tr>
              <td> <img src="delta.png" width="40px" height="40px"> </td>
              <th> date </th>
              <th> <?php echo strtoupper($origin); ?> </th>
              <th>  <?php echo $row['flight_times']; ?> </th>
              <th>  4h  </th>
              <th class="price"> $455 </th>

            </tr>
            <tr>
              <td> <img src="delta.png" width="40px" height="40px"> </td>
              <th> arrival date </th>
              <th> <?php echo strtoupper($destination); ?> </th>
              <th>  12:00p.m. - 4:00 p.m. </th>
              <th> 4h </th>
              <td colspan=> <button type="submit" class="submitbutton">Select</button> </td>
            </tr>
          </table>
      </div>

    </div>

  </form>
  </div>

</body>
<html>
