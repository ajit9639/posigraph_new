<?php
include_once("connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");
function image()
{ global $conn;
    $query="select * from  posts where userId={$_SESSION['id']}  AND type LIKE 'image%' ORDER BY postDate DESC";
    $image=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($image))
    {
        echo "<div class='col-md-4 col-sm-4 col-lg-4'>
                 <img src='imagePost/{$row['postImage']}' style='width:100%; height:300px;margin-bottom:20px;' class='w3-margin-bottom'>
               </div>";
    }
}

?>