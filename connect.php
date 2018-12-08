<?php
/* this file is for connecting to MySQL,
    creating the database 'flightdb' that we
    will use to store all information,
    and creating and filling tables that we will use */

class dbconn{
  private $username;
  private $password;
  public $conn;

//this function creates a connection to database
 function connect(){
   $username = "root";
   $password = "";
   $dsn = "mysql:host=localhost";
   $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
   try{
       $conn = new PDO($dsn, $username, $password, $options);
   }catch(PDOException $e){
     echo "Connection failed ".$e->getMessage();
     exit();
   }

   //checks to see if database exists
   //if it doesn't creates database called flightdb
   if(($this->checkIfDBExists($conn)) != true){
     //databse does not exist, so we create it
     $this->createDatabase($conn);
   }

   //creating flight information table if it doesn't exist
   if(($this->checkIfFlightTableExists($conn))!=true){
     $this->createFlightTable($conn);
   }

   //filling in flight information table with flights
   if(($this->flightTableIsEmpty($conn))==true){
     $this->fillInFlightTable($conn);
   }


 }

 //this function creates a database called flightdb
 //it then calls the function to create a table for flight information
  function createDatabase($conn){
    $sqlquery = "CREATE DATABASE flightdb";
    $conn->query($sqlquery);

  }

 //this function checks to see if database has been created
  function checkIfDBExists($conn){
    $db_check = $conn->query("SHOW DATABASES LIKE 'flightdb'");
     if ($db_check->rowCount() > 0) {
       return true;
     } else {
       return false;
     }
   }

   function createFlightTable($conn){
     $sqlquery = "CREATE TABLE flightdb.flightinfo(
       flight_num INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       flight_origin VARCHAR(20) NOT NULL,
       flight_destination VARCHAR(20) NOT NULL,
       flight_times VARCHAR(20) NOT NULL,
       flight_duration VARCHAR(20) NOT NULL,
       airline VARCHAR(20) NOT NULL
     )";

     $conn->query($sqlquery);
   }

   //this function checks to see if flight table exists
   function checkIfFlightTableExists($conn){
      $sqlquery="SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'flightinfo'";
      $db_check = $conn->query($sqlquery);
      if($db_check->rowCount()>0){
        return true;
      }else{
        return false;
      }
   }

   function flightTableIsEmpty($conn){
    $db_check = $conn->query("SELECT 1 FROM flightdb.flightinfo");
     if($db_check->rowCount()>0){
       return false; //table is not empty
     }else{
       return true;
     }
   }

   function fillInFlightTable($conn){
     $flights = array(
       array('atlanta', 'chicago', '9:10am - 10:01am', '1h51m', 'delta'),
       array('atlanta', 'chicago', '2:08pm - 3:15pm', '2h07m', 'spirit'),
       array('atlanta', 'chicago', '10:16am - 11:21am', '2h05m', 'delta'),

       array('atlanta', 'nyc', '2:00pm - 5:04pm', '2h04m', 'delta'),
       array('atlanta', 'nyc', '6:00am - 8:59am', '1h59m', 'united'),
       array('atlanta', 'nyc', '8:00am - 11:06am', '2h06m', 'united'),

       array('atlanta', 'boston', '10:16am - 11:21am', '2h05m', 'spirit'),
       array('atlanta', 'boston', '9:10am - 10:01am', '1h51m', 'united'),
       array('atlanta', 'boston', '2:08pm - 3:15pm', '2h07m', 'spirit'),


       array('chicago', 'atlanta', '2:00pm - 5:04pm', '2h04m', 'delta'),
       array('chicago', 'atlanta', '6:00am - 8:59am', '1h59m', 'united'),
       array('chicago', 'atlanta', '8:00am - 11:06am', '2h06m', 'united'),

       array('chicago', 'nyc', '9:10am - 10:01am', '1h51m', 'united'),
       array('chicago', 'nyc', '10:16am - 11:21am', '2h05m', 'spirit'),
       array('chicago', 'nyc', '2:08pm - 3:15pm', '2h07m', 'spirit'),

       array('chicago', 'boston', '2:08pm - 3:15pm', '2h07m', 'spirit'),
       array('chicago', 'boston', '9:10am - 10:01am', '1h51m', 'united'),
       array('chicago', 'boston', '10:16am - 11:21am', '2h05m', 'spirit'),


       array('nyc', 'atlanta', '9:10am - 10:01am', '1h51m', 'united'),
       array('nyc', 'atlanta', '2:08pm - 3:15pm', '2h07m', 'delta'),
       array('nyc', 'atlanta', '10:16am - 11:21am', '2h05m', 'delta'),

       array('nyc', 'boston', '2:08pm - 3:15pm', '2h07m', 'spirit'),
       array('nyc', 'boston', '9:10am - 10:01am', '1h51m', 'united'),
       array('nyc', 'boston', '10:16am - 11:21am', '2h05m', 'spirit'),

       array('nyc', 'chicago', '10:16am - 11:21am', '2h05m', 'spirit'),
       array('nyc', 'chicago', '9:10am - 10:01am', '1h51m', 'united'),
       array('nyc', 'chicago', '2:08pm - 3:15pm', '2h07m', 'spirit'),


       array('boston', 'atlanta', '2:00pm - 5:04pm', '2h04m', 'delta'),
       array('boston', 'atlanta', '6:00am - 8:59am', '1h59m', 'united'),
       array('boston', 'atlanta', '8:00am - 11:06am', '2h06m', 'united'),

       array('boston', 'chicago', '10:16am - 11:21am', '2h05m', 'spirit'),
       array('boston', 'chicago', '9:10am - 10:01am', '1h51m', 'united'),
       array('boston', 'chicago', '2:08pm - 3:15pm', '2h07m', 'spirit'),

       array('boston', 'nyc', '8:00am - 11:06am', '2h06m', 'united'),
       array('boston', 'nyc', '6:00am - 8:59am', '1h59m', 'united'),
       array('boston', 'nyc', '2:00pm - 5:04pm', '2h04m', 'delta'),
     );


     foreach($flights as $thisflight){
       $elem = 0;
       $values = "'".$thisflight[0]."','".$thisflight[1]."','".$thisflight[2]."','".$thisflight[3]."','".$thisflight[4]."'";
       $sqlquery = "INSERT INTO flightdb.flightinfo(flight_origin, flight_destination,
          flight_times, flight_duration, airline)
          VALUES (".$values.")";
          try{
            $conn->query($sqlquery);
          }catch(Exception $e){
            echo $e->getMessage();
          }

     }

   }

}


?>
