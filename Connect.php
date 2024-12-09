<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'attendance management');
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($conn ===false){
    die("Error: Could not connect. ".mysqli_connect_errno());
}
// else{
//     echo'good job, brr';
// }
