<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "websurveypal";

//connect to mySQL
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//check
if (mysqli_connect_error()){
    echo "Database Error";
}

?>