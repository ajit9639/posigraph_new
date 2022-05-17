
<?php
session_start();
include("connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
$me=$_SESSION['id'];

if(isset($_POST['btn'])&&isset($_POST['pid']))
{
//    then put a swtich for like or inset+loading commnt
    $btn=$_POST['btn'];
    $pid=$_POST['pid'];
    switch($btn)
    {
        case "insert" :
            $text=$_POST['comment'];
            insertComment($pid,$text);
            break;
        case "like" :
            loadLikes($pid);
            break;
        case "allComments" :
            allComments($pid);
            break;    
    }
}
else
{
    $pid=$_POST['pid'];
//    defautl load comment
    loadComments($pid);
    
}




function loadComments($pid)
{
  global $conn;
    $query="select * from comments where postId='$pid'  ORDER BY commentDate DESC";
    $comments=mysqli_query($conn,$query);
   if($comments)
   {
       if(mysqli_num_rows($comments)>0)
       {
          while($row=mysqli_fetch_array($comments))
           {
              $query="select * from user where userId='".$row['commentBy']."'";
             $user=mysqli_query($conn,$query);
              $userName=mysqli_fetch_array($user);
              $date=date('F j,Y,g:i a',strtotime($row['commentDate']));
              $data=$row['comment'];
            //   echo "<h4 style='color:#000'>".$userName['firstName']."   .... ".$date."</h4>";
              echo "<h4 style='color:#000'>".$userName['firstName']." ". $userName['lastName']."</h4>";
              echo "<span style='color:#000'>".$date." "."</span>";
              echo"<p style='color:red'>$data</p>"."<hr>";
           } 
       }
       else
           echo"<p>No comments available.";
       
   }   
    else
    {
        echo "error";
        mysqli_error($conn);
    }
    
}

function loadLikes($pid)
{
     global $conn;
    $query="select * from likes where postId='$pid'  ORDER BY likeDate DESC";
    $likes=mysqli_query($conn,$query);
   if($likes)
   {
       if(mysqli_num_rows($likes)>0)
       {
          while($row=mysqli_fetch_array($likes))
           {
              $query="select * from user where userId='".$row['likeBy']."'";
             $user=mysqli_query($conn,$query);
              $userName=mysqli_fetch_array($user);
              $date=date('F j,Y,g:i a',strtotime($row['likeDate']));
             
              echo "<h5 style='color:black'>".$userName['firstName']."   .... ".$date."</h5><hr>";
             
           } 
       }
       else
           echo"<p>No likes available.</p>";
       
   }   
    else
    {
        echo "error";
        mysqli_error($conn);
    }
}

function insertComment($pid,$text)
{
//    after insertion load comment 
    global $conn,$me;
    $query="insert into comments(postId,commentBy,comment,commentDate) values('$pid','$me','$text',Now())";
   $result=mysqli_query($conn,$query);
    loadComments($pid);
}
function allComments($pid)
{
     loadComments($pid);
}

?>
