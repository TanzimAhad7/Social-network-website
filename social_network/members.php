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
	<title>Find people</title>
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
</style>
<body>
<div class="row">
	<div class="col-sm_12">
	<center><h2>Find New People</h2></center><br><br>
	<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
	<form class="search_form" action="">
	<input type="text" placeholder="search friend" name="search_user">
	<button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
	</form>
	</div>
	<div class="col-sm-4">
    </div>
	</div><br><br>
	<?php search_user()  ?>
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