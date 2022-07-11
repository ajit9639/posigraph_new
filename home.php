<?php
 session_start();
 
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include_once("database/connection.php");
   include_once("database/getPost.php");
    include("database/getMyImagePost.php");
    include("database/getMsgNotif.php");
    
    $query="select * from user where userId=".$_SESSION['id'];
    $result=mysqli_query($conn,$query);
    $user=mysqli_fetch_array($result);
    
     $query="select * from user_details where userId='".$_SESSION['id']."'";
    $result=mysqli_query($conn,$query);
    $userDetail=mysqli_fetch_array($result);

    include "posi_header.php";
    include "posi.php";

    

    // ajit
   

    // //ajit
    ?>
   <style>

   </style>
   
    <!-- profile section started -->
        <div class="container-fluid">
          <div class="row ">
            <div class="col-lg-12 profile-section">
             
              <div>

                <div class="col-md-12">
                  <div class="profile-card text-center">

                    <img class="img-responsive img-fluid" src="https://images.unsplash.com/photo-1454678904372-2ca94103eca4?crop=entropy&fit=crop&fm=jpg&h=975&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1925">
                    <div class="profile-info">
                      <img class="profile-pic" src="dp/<?php echo $user['dp'];?>">
                      <h2 class="hvr-underline-from-center"><?php echo $user['firstName'].' ' .$user['lastName'];?></h2>
                      <?php 
                      $one = $user['userId'];
                     
                      $get_following = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM `friends` WHERE `userOne`='$one' || `userTwo`='$one'"));
                      $get_follower = mysqli_num_rows(mysqli_query($conn,"select receiverId from friend_request where senderId='$one'"));
                      ?>
                      <div><?php echo "<a class='btn btn-info text-light mr-2'>Following $get_following</a>"."<a class='btn btn-info text-light'>Followers $get_follower</a>"?></div>
                      <!-- <span>Digital / Design Consultant</span> -->
                  
                    </div>
                    <div class="profile-gallery-images">
                     
                        <div class="row">                         
                         
                          <?php image();?>
                          
                        </div>
                 
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
    <!-- end profile section -->
  </body>
</html>


<?php
    
}
?>
