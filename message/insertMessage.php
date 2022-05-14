<?
 session_start();
include("../database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
//fetch receiver Id ,session id, content, confirmation button/ attrib to insert
    if(isset($_POST['validReceiver']))
    {
         $id=$_POST['receiverId'];
         $me=$_POST['me'];
         $msg=$_POST['msg'];            
            if($msg=="")
            {
                echo "<script>window.alert('type msg')</script>";
            }
            else
            {
//0 means unread
                
                $nsertMsg="insert into message(senderId,receiverId,messageContent,messageDate,messageStatus) values('$me','$id','$msg',NOW(),'0')";
                 if(mysqli_query($conn,$nsertMsg)){
                    
                 }
                else
                    echo mysqli_error($conn);
                  
             
              }
       

        
    }
    else
         echo "sorry somthing went wrong";

?>