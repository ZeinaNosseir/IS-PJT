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

// retrieve recoord from database
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
echo "</tr>";
}

echo "</table>";
}
// alert message if records not available
else
{
echo "No results to display!";
}
}
else
{
echo "Error: " . $db->error;
}
 
// close database connection 
$db->close();
?>
  
</html>