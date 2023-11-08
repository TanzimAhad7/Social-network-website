<!DOCTYPE html>
<?php
session_start();
include 'includes/header.php';

if (!isset($_SESSION['user_email'])) {
    header('location: index.php');
}
?>
<html>
<head>
	
	 <title>Messages</title>
	 <meta charset="utf-8">
 	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<style>
	
    #scroll_messages{
        max-height: 500px;
        overflow: scroll;
    }
    #btn-msg{
        width: 20%;
        height: 28px;
        border-radius: 5px;
        border: none;
        color: #fff;
        float: right;
        background-color: green;
    }
    #select_user{
        max-height: 500px;
        overflow: scroll;
    }
    #green{
        background-color:#2F4F4F;
        border:2px solid green ;
        width: 51%;
        padding: 5px 20px;
        font-size: 16px;
        border-radius: 20px;
        word-wrap: break-word;
        float: left;
        margin-bottom: 2px;
        color: #fff;
    }
    #blue{
        background-color: #2F4F4F;
        border:2px solid darkblue ;
        width: 51%;
        padding: 5px 20px;
        font-size: 16px;
        border-radius: 20px;
        word-wrap: break-word;
        float: right;
        margin-bottom: 2px;
        color:white;
    }

</style>
<body>
<div class="row">
    <?php
     if (isset($_GET['u_id'])) {
         global $con;

         $get_id = $_GET['u_id'];
         if ($get_id == 'new') {
             $user_to_msg = ' ';
             $user_to_name = ' ';
         } else {
             $get_user = "select * from users where user_id='$get_id'";

             $run_user = mysqli_query($con, $get_user);
             $row_user = mysqli_fetch_array($run_user);
             $user_to_msg = $row_user['user_id'];
             $user_to_name = $row_user['user_name'];
         }
     }

     $user = $_SESSION['user_email'];
     $get_user = "select * from users where user_email='$user'";
     $run_user = mysqli_query($con, $get_user);
     $row = mysqli_fetch_array($run_user);

     $user_from_msg = $row['user_id'];
     $user_from_name = $row['user_name'];
 ?>

 <div class = "col-sm-3" id="select_user">
  <?php
    $user = 'select * from users';

    $run_user = mysqli_query($con, $user);
    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $first_name = $row_user['f_name'];
        $last_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        echo"
        
        <div class='container-fluid'>
         <a style='text-decoration: none; cursor:pointer; color:white;' href='
         messages.php?u_id=$user_id'>
         <img class = 'img-circle' src='users/$user_image' width='90px'
         height='80px' title='$user_name'><strong>&nbsp $first_name $last_name</strong><br><br>
         </a>
        </div>
        
        ";
    }
  ?>
 </div>
 <div class="col-sm-6">
  <div class="load_msg" id="scroll_messages">
   <?php
   $sel_msg = "select * from user_messages where (user_to='$user_to_msg' AND
   user_from='$user_from_msg') OR (user_from='$user_to_msg' AND 
   user_to='$user_from_msg') ORDER by 1 ASC";

   $run_msg = mysqli_query($con, $sel_msg);

   while ($row_msg = mysqli_fetch_array($run_msg)) {
       $user_to = $row_msg['user_to'];
       $user_from = $row_msg['user_from'];
       $msg_body = $row_msg['msg_body'];
       $msg_date = $row_msg['date']; ?>
       <div id="loaded_msg">
           <p><?php if ($user_to == $user_to_msg and $user_from ==
           $user_from_msg) {
           echo "<div class='message' id='blue' data-toggle=
           'tooltip' title='msg_date'>$msg_body</div><br><br><br>";
       } elseif ($user_from == $user_to_msg and $user_to == $user_from_msg) {
           echo" <div class='message' id='green'
            data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";
       } ?></p>

       </div>
       <?php
   }
   ?>
  </div>
  <?php
  if (isset($_GET['u_id'])) {
      $u_id = $_GET['u_id'];
      if ($u_id == 'new') {
          echo'
          
          <form>
          <center><h3>select someone to start conversation</h3></center>
          <textarea disabled class="form-control" placeholder="Enter your text">
          </textarea>
          <input type="submit" class ="btn btn-default" disabled value="send">
          </form><br><br>
          
          ';
      } else {
          echo'
          
        <form action="" method="POST">
        <textarea class="form-control" placeholder="Enter your text" name="msg_box" id="message_textarea">
        </textarea>
        <input type="submit" name="send_msg" id="btn-msg" value="send">
        </form><br><br>
        
        ';
      }
  }
 ?>
 <?php
 if (isset($_POST['send_msg'])) {
     $msg = htmlentities($_POST['msg_box']);

     if ($msg == '') {
         echo"<h4 style='color:red; text=align: center;'>Message was unable to send!</h4>";
     } else {
         $insert = "insert into user_messages
         (user_to,user_from,msg_body,date,msg_seen) values
         ('$user_to_msg','$user_from_msg', '$msg', NOW(),'no')";

         $run_insert = mysqli_query($con, $insert);
     }
 }

 ?>
 
 </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
  function addDarkmodeWidget() {
    new Darkmode().showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>
</body>
</html>