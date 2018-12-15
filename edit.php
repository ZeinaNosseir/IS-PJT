<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Edit</h2>
  </div>
	 
  <form method="post" action="edit.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label ><font color="white">Username</font></label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label><font color="white">grade</label>
  		<input type="grade" name="grade">
  	</div>
    
    
  	<div class="input-group">
          <button type="submit" class="btn" name="Edit_Grade">Edit</button>
        
  	</div>
  	<p>
  		 <a href="lecturer.php">Back</a>
  	</p>
  </form>
</body>
</html>