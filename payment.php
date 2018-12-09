<?php
  session_start();

?>

<!DOCTYPE html>
<html>
<head><title> Preferences </title>

  <link rel = "stylesheet" type="text/css" href = "payment.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">

</head>

<body>
  <?php
    if(isset($_SESSION["price"])){
      $price = $_SESSION["price"];
    }
  ?>

  <header>
    <h1 class="slogan"><img src="plane.png" id="airplane" width="150px" height="100px">FlyEasy</h1>

  </header>

  <div id="preferences" class = "display">
    <h2> Please enter in your payment details </h2> <br/>
    <img src="mastercard.png" width="50px" height="50px">
    <img src="americanexpress.png" width="50px" height="50px">
    <img src="discover.jpg" width="50px" height="50px">
    <img src="visa.jpg" width="50px" height="50px"> <br/><br/>
      Total flight cost: $<?php echo $price; ?> <br/><br/>
    <form id="frm" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      Card number: <input type="textfield"></input> <br/><br/>
      Security code: <input type="textfield" size="3"></input> <br/><br/>
      Name on card: <input type="textfield"></input> <br/><br/>
      Expiration date: <input type="textfield" value="MM" length="2" size="2"></input> / <input value="YY" type="textfield" size="2"> <br/><br/>

    </form>

    <a href="confirmationpage.html">
    <button  class="submitbutton" id="findflights" >
        Validate payment
    </button>
  </a>
    <br/> <br/>
    <a href="" id="link">

    </a>

  </div>




</body>
</html>
