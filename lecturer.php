<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Edit Grades</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<?php
// connect to the database
include('server.php');

$_SESSION ['username']= $username;

// get the records from the database
if ($result = $db->query("SELECT * FROM students"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>username</th><th>grade</th><th>Properties</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->username . "</td>";
echo "<td>" . $row->grade . "</td>";
echo "<td><a href=' edit.php'>Edit</a></td>";
//echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $db->error;
}

/*if (isset($_UPDATE['edit_students'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $grade = mysqli_real_escape_string($db, $_POST['grade']);
    $query = "UPDATE grade where username = '$username'"; 

    mysqli_fetch_assoc($query);

    if ($db->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
    }
    }*/
  
// close database connection 
$db->close();
//<a href="records.php">Add New Record</a> mafrood tb2a taht
?>

  
</html>