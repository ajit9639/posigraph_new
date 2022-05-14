<?php
session_start();
include("database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
if(mysqli_query($conn,"update user set logInStatus='Offline' where userId=".$_SESSION['id']))
{
     session_destroy();
    header("location:index.php");

}
else
    echo mysqli_error($conn);

?>