<?php
	include_once('server.php');

	if( isset($_GET['edit']) )
	{
		$username = $_GET['edit'];
		$res= mysql_query("SELECT * FROM students WHERE username='$username'");
		$row= mysql_fetch_array($res);
	}

	if( isset($_POST['newGrade']) )
	{
		$newGrade = $_POST['newGrade'];
		$grade	 = $_POST['grade'];
		$sql     = "UPDATE students SET grade='$newGrade' WHERE username='$username'";
		$res 	 = mysql_query($sql) 
                                    or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=index.php'>";
	}

?>
<form action="edit.php" method="POST">
Grade: <input type="text" name="newName" value="<?php echo $row[1];?>"><br />
<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
<input type="submit" value=" Update "/>
</form>