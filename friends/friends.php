<?php 
// session_start();

  include("showUsers.php");

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/w3.css">
    <link rel="stylesheet" href="../style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <style>
    .all-user {
        /* height: 590px;
        background: red; */
    }

    .new-user {
        margin-top:65px;
        height: 280px;
        background: cyan;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .requested-user {
        height: 300px;
        background: green;
        overflow-x: hidden;
        overflow-y: scroll;
        margin-top: 5px;
        box-shadow: -1px 10px 100px 5px green;
        border-radius: 15px;
    }

    .known-user {
        height: 590px;
        /*            background:green;*/
    }

    .known-user .request-list {
        height: 275px;
        /*            background: pink;*/
        overflow-x: hidden;
        overflow-y: scroll;
        box-shadow: -1px 10px 100px 5px gray;


    }

    .known-user .friend-list {
        height: 300px;
        background: gray;
        overflow-x: hidden;
        overflow-y: scroll;
        margin-top: 10px;
        box-shadow: -1px 10px 100px 5px green;
        border-radius: 10px;

    }

    .user-detail {
        height: auto;
        /*        background:aqua;*/
        margin: 5px;
        padding: 0;

    }

    .user-pic img {
        height: 90px;
        width: 90px;
    }

    .user-detail .user-name-buttons {
        margin-top: 5px;
    }

    .user-detail .user-name-buttons p {
        font-size: 20px;
        font-family: cursive;
    }

    .user-detail .user-name-buttons button {
        width: 100px;
        padding: 4 10px;
        font-size: 15px;
        outline: none;
        border: none;
        border-radius: 5px;
    }

    .friend-pic {
        height: 90px;
        width: 90px;
        overflow: hidden;
        border-radius: 50%;
    }

    .friend-pic img {
        width: 100%;
    }
    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-6 all-user">
                <!-- suggested friends -->
                <div class="row new-user">
                    <?php friendsOfFriend($_SESSION['id']); 
                           moreSugg();?>
                </div>
              
                <div class="row requested-user">
                    <?php meToUsers();?>
                </div>
            </div>


            <div class="col-sm-6  col-xs-6 known-user">
          
                <div class="row request-list">
                    <?php usersToMe();?>
                </div>
                <div class="row friend-list">
                    <?php  myFriends();?>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}


$(".request-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "request";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    // window.alert(userId);
    callFun.append("userName", userName);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            // window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {request}");
        }
    });


});

$(".cancel-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "cancel";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {cancel}");
        }
    });
});

$(".ignore-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "ignore";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);
    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');

        },
        error: function(result) {
            window.alert(" sorrry error {ignored}");
        }
    });
});

$(".accept-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "accept";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error {accepted}");
        }
    });
});

$(".unfriend-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "unfriend";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error occured {unfriend}");
        }
    });
});
</script>
<style>

</style>
<!--
request butn can only be shown when  user has not send reqst .. cancel vice virsa
so use data base for checkin reqst table for the first time

so there would  be a check fucntion/or php page  call both time


     <div class='col-sm-12 user-detail'>
                    
                       <div class='col-sm-4 user-pic'> 
                             <img src='../proImg/pro.jpg'>    
                        </div>

                        <div class='col-sm-7 user-name-buttons'> 
                            <div class=" row name"><a href="#"><p style="margin:10px 10px;">Abul Hasan</p></a></div>
                           <div class="row btn">
                               
                               <a id="request" href="#"><button id="request-btn" >Request</button></a>
                                <a  id="cancel" href="#"><button style="display: none;" id="cancel-btn">Cancel</button></a>
                            
                            </div>
                            
                        </div>
                   
                  </div>
                  



knowl
                  <div class='col-sm-12 user-detail'>

                             <div class="col-sm-5">
                                   <div class='friend-pic round-pic'> 
                                         <img src='../proImg/pro.jpg'>    
                                    </div>
                             </div>

                            <div class='col-sm-7 user-name-buttons'> 
                                <div class=" row name"><a href="#"><p style="color:white;margin:10px 10px;">Abul Hasan</p></a></div>
                               <div class="row btn"> <a href="#"><button>Unfriend</button></a></div>

                            </div>

                          </div>
    
    
-->


<!--    

                        <button class="test" data-id="new"> 0</button>
                        <button class="test" data-id="has">1</button>


                 $(".test").click(function(){
                    var $this=$(this)
                    v=$this.data("id");  // data receive use this id for verification or ajax(crud)
                    window.alert(v);
                });

-->

</html>