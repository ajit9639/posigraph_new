<?php
include("../database/connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");
$friends=getFriends($_SESSION['id']);
$userList="select * from user where userId IN($friends)"; // here select only friends using in operatr
$friendList=mysqli_query($conn,$userList);
if($friendList)
{
    while($friends=mysqli_fetch_array($friendList))
    {
        $userId=$friends['userId'];
        $userName=$friends['firstName'];
        $dp=$friends['dp'];
        $logInStatus=$friends['logInStatus'];
        $flag;

                   if($logInStatus=="Online")
                     {
                         $flag="Online";
                         $color="#49ba26";
                     }
                    else
                    {
                      $flag="Ofline";
                        $color="#ee434200";

                    }
         $total=unseen($_SESSION['id'],$userId);
        if($total!=0)
            $read="($total)";
        else
            $read="";

            echo "
               <div class='online-user-img' style='display:inline-block'>

               <p style='color:cyan;font-size:18px;margin: 0px;'>
               <a style='style=color:black;font-size: 18px;display:block;font-weight: 600;color:#000;position: absolute;
               left: 100px;' href='chatApp_me.php?id=$userId'> $userName </a>    
              
              
               </p> 
               

                <img src='../dp/{$dp}'>
              </div>
              <span style='color: black;
              font-weight: 800;margin-left: -15px;' id='unreadOf{$userId}'>$read</span>
              
              

              </a> 
              <span>
              <i style='color: $color;font-size: 12px;' class='fa fa-circle' aria-hidden='true'></i>        
              </span>

              <div class='online-user-name' style='display:inline-block'>
              </div> <hr>";          
           
    }

    // <p style='color:cyan;font-size:18px'>
    // <a style='style=color:black;font-size: 18px;display:block;font-weight: 600;color:#000;' href='chatApp_me.php?id=$userId'> $userName </a>
                  
    // </p>
    // <span style='float:right;width:35%;'> <a class='' href='chatApp_me.php?id=$userId'>Click to chat</a>
    // </span>

    
}
else
    echo mysqli_error($conn);

function getFriends($id)
{ global $conn;
    $i=0;
      $friendId[]=0;
    $query="select userOne,userTwo from friends where userOne=$id or userTwo=$id";// when i'am 1st col,get friend Id from userTwo
     $friends=mysqli_query($conn,$query);
    if($friends)
    {
     if(mysqli_num_rows($friends)>= 1)
     {  
           while($row=mysqli_fetch_array($friends))
           {
               
                  if($row['userOne']==$id)
                  {
                     $friendId[$i]=$row['userTwo'];
               
                     $i++;                       
                  }
                 else
                 {
                     $friendId[$i]=$row['userOne'];
               
                     $i++;
                      
                 }
           }
        
     
     $str =implode(',', $friendId);
         return $str;
     }
        else
            return 0;

    }
 else
      mysqli_error($conn);
 
}
function unseen($me,$id)
{
   global $conn;
    $query="select COUNT(*) from message where receiverId='$me' AND senderId='$id' AND messageStatus='0'";
    $unread=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($unread);
    return $total[0];
}
       
        ?>

