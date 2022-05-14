<?php
if(isset($_POST['comment-btn']))
{
  $pid=$_POST['pid'];

   
}
?>  

<div id="dynamic">
              <br>
             <span class="w3-right w3-opacity"><button id="close-popUp">XX</button></span>
               <button type="button" data-pid='<?php echo $pid ?>' class="all-likes w3-button w3-theme-d1 w3-margin-bottom">
                   <i class="fa fa-thumbs-up"></i> &nbsp; All Likes</button> 
    
              <button type="button" data-pid='<?php echo $pid ?>' class="all-comments w3-button w3-theme-d1 w3-margin-bottom">
                   <i class="fa fa-comment"></i> &nbsp; All comments</button>
    
               <input type="text" name="comment-text" id="comment-text">
              <button type="button"  data-pid='<?php echo $pid ?>' class=" insert-comment w3-button w3-theme-d2 w3-margin-bottom">
                  <i class="fa fa-comment"></i> &nbsp; comment</button>
             
              <hr class="w3-clear">
               
                <div id="comment-like-div" style="background:brown; box-shadow:0px 0px 100px 5px white">
                
                  </div>

  </div>

<script>

    
    $(document).ready(function(){
//        when pop up div is loaded then load all comment  for first time
          var pid="<?php echo $pid ?>";
             postId=new FormData();  
             postId.append("pid",pid);
              
                        $.ajax({
                           method: 'post',
                              url :"database/postFunctions.php", 
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){ // here uptp latest appended data
                                 $("#comment-like-div").html(loadData);
                              }
                          });
        
    });
  
    
    $(".insert-comment").click(function(){
        //        insert comemnt into comment database and load after insertion

        $comment_text=$("#comment-text").val();
         var $this=$(this);
           pid=$this.data("pid");
       if($comment_text!="")
           {
           
            $("#comment-text").val("");
             postId=new FormData();  
             postId.append("pid",pid);
            postId.append("comment",$comment_text);
              postId.append("btn","insert");

        
                        $.ajax({
                           method: 'post',
                              url :"database/postFunctions.php", 
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){ // here uptp latest appended data
                               $("#comment-like-div").html(loadData);
                              }
                          });
           }
        else
            window.alert("write your comment");
//       (/ database) is bcoz 1st time output is going to home page which is outside of database          then next time it would be located from home pahe not from this dir 
    });
    
    
    $(".all-likes").click(function(){
//       load all like from likes atble using ajax
                  var $this=$(this);
                   pid=$this.data("pid");
                    postId=new FormData();  
                     postId.append("pid",pid);
                      postId.append("btn","like");
                        $.ajax({
                           method: 'post',
                              url :"database/postFunctions.php", 
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){ // here uptp latest appended data
                               $("#comment-like-div").html(loadData);
                              }
                          });
       
    });
    
    
    $(".all-comments").click(function(){
//       load all like from likes atble using ajax
                  var $this=$(this);
                   pid=$this.data("pid");
                    postId=new FormData();  
                     postId.append("pid",pid);
                      postId.append("btn","allComments");
                        $.ajax({
                           method: 'post',
                              url :"database/postFunctions.php", 
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){ // here uptp latest appended data
                               $("#comment-like-div").html(loadData);
                              }
                          });
       
    });
    
    
     $("#close-popUp").click(function(){
     $("#pop-up-div").css("display","none");
           
       });
</script>