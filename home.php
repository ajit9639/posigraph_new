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
    include "./friends/friends_slider.php";
    ?>
   
   
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
                      <h2 class="hvr-underline-from-center"><?php echo $user['firstName'].' ' .$user['lastName'];?>
                      <!-- <span>Digital / Design Consultant</span> -->
                    </h2>
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
