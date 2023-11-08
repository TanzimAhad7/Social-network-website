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
	<title>User_Posts</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<style>
	.btn{
		background-color: dimgray;
	}
    #own_posts{
        border: 1px solid darkblue;
        padding: 40px 50px;
        width: 90%;
    }
    #posts-img{
        height: 300px;
        width: 100%;
    }
</style>
<body>
<div class="row">
<?php

if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];
}
if ($u_id < 0 || $u_id == '') {
    echo"<script>window>open('home.php', '_self')</script>";
} else {
    ?>

<div class="col_sm_12">
<?php
if (isset($_GET['u_id'])) {
        global $con;

        $user_id = $_GET['u_id'];

        $select = "select * from users where user_id='$user_id'";
        $run = mysqli_query($con, $select);
        $row = mysqli_fetch_array($run);

        $name = $row['user_name'];
    } ?>

<?php

if (isset($_GET['u_id'])) {
    global $con;

    $user_id = $_GET['u_id'];

    $select = "select * from users where user_id='$user_id'";
    $run = mysqli_query($con, $select);
    $row = mysqli_fetch_array($run);

    $id = $row['user_id'];
    $image = $row['user_image'];
    $name = $row['user_name'];
    $f_name = $row['f_name'];
    $l_name = $row['l_name'];
    $describe_user = $row['describe_user'];
    $country = $row['user_country'];
    $gender = $row['user_gender'];
    $register_date = $row['user_reg_date'];

    echo"
    <div class='row'>
    <div class = 'col-sm-1'>
    </div>
    <center>
    <div style='background-color:black;' class ='col-sm-3'>
    <img class = 'img-circle' src='users/$image' width='150' height='150'>
    <br><br>
    <ul style='background-color:black;color:grey'class='list_group'>
    <li style='background-color:black'class = 'list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
    <li style='background-color:black'class = 'list-group-item' title='Country'><strong>$user_country</strong></li>
    <li style='background-color:black'class = 'list-group-item' title='Register Date'><strong>$register_date</strong></li>
    </ul>
    ";

    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $userown_id = $row['user_id'];

    /*

    if ($user_id == $userown_id) {
        echo"<a href='edit_profile.php?u_id='$userown_id' class='btn btn-info'>Edit Profile</a><br><br><br>";
    }

    */

    echo'
    </div>
    </center>
    ';
} ?>

<div class="col-sm-8">
<center style="color:grey"><h2><strong><?php echo"$f_name $l_name's"; ?><strong> Posts</h2></center>

<?php

global $con;

    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
    }

    $get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 10";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];

        $user = "select * from users where user_id = '$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $f_name = $row_user['f_name'];
        $l_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        $ext = pathinfo($upload_image, PATHINFO_EXTENSION);

        if ($ext == 'mp4') {
            if ($content == 'No' && strlen($upload_image) >= 1) {
                echo"
           <div id='own_posts'>
              <div class='row'>
               <div class='col-sm-2'>
               <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
               </p>
               </div>
               <div class='col-sm-6'>
               <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
               <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
               </div>
               <div class='col-sm-4'>
               </div>
               </div>
               <div class='row'>
               <div class = 'col-sm-12'>
               <video width='550' height='340' controls>
               <source src='imagepost/$upload_image' type='video/mp4'>
               </video>
               </div>
               </div><br>
               <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
              
           </div><br><br>
          ";
            } elseif (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo"
                <div id='own_posts'>
                <div class='row'>
                <div class='col-sm-2'>
                <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
                </p>
                </div>
                <div class='col-sm-6'>
                <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
                </div>
                <div class='col-sm-4'>
                </div>
                </div>
                <div class='row'>
                <div class = 'col-sm-12'>
                <p><medium style='color:white;'>$content</medium></p>
                <video width='550' height='340' controls>
                <source src='imagepost/$upload_image' type='video/mp4'>
                </video>
                </div>
                </div><br>
                <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
               
                </div><br><br>
         ";
            } else {
                echo"
          <div id='own_posts'>
             <div class='row'>
               <div class='col-sm-2'>
               <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
               </p>
               </div>
               <div class='col-sm-6'>
               <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
               <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
               </div>
               <div class='col-sm-4'>
               </div>
               </div>
               <div class='row'>
               <div class = 'col-sm-12'>
               <p><medium style='color:white;'>$content</medium></p>
               </div>
               </div><br>
               <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
               </div><br><br>
         ";
            }
        } else {
            if ($content == 'No' && strlen($upload_image) >= 1) {
                echo"
        <div id='own_posts'>
           <div class='row'>
           <div class='col-sm-2'>
           <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
           </p>
           </div>
           <div class='col-sm-6'>
           <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
           <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
           </div>
           <div class='col-sm-4'>
           </div>
           </div>
           <div class='row'>
           <div class = 'col-sm-12'>
           <img id= 'posts-img' src ='imagepost/$upload_image' style='height:350px;'>
           </div>
           </div><br>
           <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
          
       </div><br><br>
      ";
            } elseif (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo"
      <div id='own_posts'>
         <div class='row'>
            <div class='col-sm-2'>
            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
            </p>
            </div>
            <div class='col-sm-6'>
            <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
            <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
            </div>
            <div class='col-sm-4'>
            </div>
         </div>
         <div class='row'>
         <div class = 'col-sm-12'>
         <p><medium style='color:white;'>$content</medium></p>
         <img id='posts-img' src ='imagepost/$upload_image' style='height:350px;'>
         </div>
         </div><br>
         <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
        
     </div><br><br>
     ";
            } else {
                echo"
      <div id='own_posts'>
         <div class='row'>
            <div class='col-sm-2'>
            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'> 
            </p>
            </div>
            <div class='col-sm-6'>
            <h3><a style='text-decoration:none; cursor:pointer;color: #f2f2f2;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
            <h4><small style='color:white;'>Updated a post on <strong>$post_date</strong></small></h4>
            </div>
            <div class='col-sm-4'>
            </div>
         </div>
         <div class='row'>
         <div class = 'col-sm-12'>
         <p><medium style='color:white;'>$content</medium></p>
         </div>
         </div><br>
         <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View</button></a>
         </div><br><br>
     ";
            }
        }
    } ?>
</div>
</div>
</div>
<?php
} ?>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
  function addDarkmodeWidget() {
    new Darkmode().showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script> 
</body>
</html>