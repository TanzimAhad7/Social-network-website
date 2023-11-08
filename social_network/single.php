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
        <title>
            view your posts</title>
    <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
    <div clss="row">
        <div class="col-sm-12">
            <center><h2 style="color:grey">Comments</h2></center>
            <?php single_post(); ?>
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