<?php
include("connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");
function getUnreadMsg($id)
{
   global $conn;
    $query="select COUNT(*) from message where receiverId='$id' AND messageStatus='0'";
    $unread=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($unread);
    return $total[0];
}
function getTotalUnseenNotif($id)
{
//    get all notification where notificationStatus= new 
//return count /how many
    global $conn;
    $query="select COUNT(*) from notifications where notificationFor='$id' AND notificationStatus='new'";
    $new=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($new);
    return $total[0];
    
    
}
function changeNotifStatus($id)
{
//when user first click or click on notification button then change all new notification to old
     global $conn;
    $query="update notifications set notificationStatus='old' where notificationFor='$id' AND notificationStatus='new'";
    $update=mysqli_query($conn,$query);
    echo getTotalUnseenNotif($id); // will be called from ajxa
}
function getAllNotif($id)
{
//  when loading whither it is seen or not if not the change color if seen then change its color
    
     global $conn;
    $query="select * from notifications where notificationFor='$id' ORDER BY date DESC";
    $all=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($all))
    {
      
        
        
        if(($row['notificationType']=='like')||($row['notificationType']=='comment'))
        {
//            attached post id also check notif seen or not
        
            if(isNotifSeen($id,$row['notificationId']))
            {
                echo" <a href='./database/seePost.php?notifId={$row['notificationId']}&postId={$row['postId']}' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' data-postId='{$row['postId']}' style='background:darkGray'>{$row['notificationMessage']}</a>";
            }
            else
            {  
                echo" <a href='./database/seePost.php?notifId={$row['notificationId']}&postId={$row['postId']}' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' data-postId='{$row['postId']}' style='background:gray'>{$row['notificationMessage']}</a>";
            }
           
        }
        else
        {
             if(isNotifSeen($id,$row['notificationId']))
            {
               echo" <a href='#' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' style='background:darkGray'>{$row['notificationMessage']}</a>";
            }
            else
            {
                     echo" <a href='#' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' style='background:gray'>{$row['notificationMessage']}</a>";
            }
       
        }
        
        
    }
   
    
    
}
function insertNotifIntoSeen($id,$notifId)
{
//   Ajax 
//    before inserting notification check already inserted or not call is notifSeeen ii it returns true means already inserted , do not insert more
}
function isNotifSeen($id,$notifId)
{
    global $conn;
    $query="select COUNT(*) from notifications_Seen where seenBy='$id' AND notificationId='$notifId'";
    $result=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($result);
    if($total[0]>=1)
        return true;
    else
        return false;
}
//function getUnreadMsgOfAFriend($id,$freind)
//{
//    // define this fucntion in chatApp.php and count how many msg of a friend is unred then show it on online div
//}

//function changeMsgToRead($id,$friendId)
//{
////    change all msg of friendId to read when userClick on send button or namebutton to load the msg into chatDiv
//}
//first insertion then redirection in notif seen case and check point

?>