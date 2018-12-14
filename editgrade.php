<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
  <form method="post" action="editgrade.php">
  	<?php include('errors.php'); ?>
      <div class="input-group">
  	  <label>grade</label>
  	  <input type="grade" name="grade" value="<?php echo $grade; ?>">
  	</div>

    <div class="input-group">
  	  <label>username</label>
  	  <input type="username" name="username" value="<?php echo $username; ?>">
  	</div>

    <button type="submit" class="btn" name="view_students">edit grade </button>
  	</div>
  </form>
</body>
</html>