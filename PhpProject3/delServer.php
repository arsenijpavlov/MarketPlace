<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hosting";
$port = 3308;
$con = mysqli_connect($host, $user, $password, $database, $port);
$tab = mysqli_select_db($con, $database);

if(isset($_GET['CS']))
    $_SESSION['server'] = $_GET['CS'];

$pull = "DELETE FROM `Сервера` "
        . "WHERE `КодСервера`=".$_SESSION['server'];
$res = $con->query($pull);
exit("<meta http-equiv='refresh' content='0; url= /PhpProject3/catalog.php'>");
?>