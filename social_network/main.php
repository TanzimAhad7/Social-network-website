<!DOCTYPE html>
<html>
<head>
	<title>RUET Connect login and signup</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
	body{
		overflow-x: hidden;
	}
	
	#signup{
		margin-top: 50px;
		width: 50%;
		border-radius: 30px;
	}
	#login{
		width: 50%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: #1da1f2;
		border-radius: 30px;
	}
	#login:hover{
		width: 50%;
		background-color: #fff;
		color: #1da1f2;
		border: 2px solid #1da1f2;
		border-radius: 30px;
	}
	.well{
		background-color: #187FAB;
	}

</style>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;">RUET Connect</h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6" style="left:38%;">
			<img src="images/raj.jpg" class="img-rounded" title="" width="300px" height="365px">
			
			<form method="post" action="">
				<button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br><br>
				<?php
                    if (isset($_POST['signup'])) {
                        echo "<script>window.open('signup.php','_self')</script>";
                    }
                ?>
				<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>
				<?php
                    if (isset($_POST['login'])) {
                        echo "<script>window.open('signin.php','_self')</script>";
                    }
                ?>
			</form>
		</div>
		</div>
		
	</div>
</body>
</html>