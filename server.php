<?php
session_start();

// first we initialize variables
$name = "";
$email    = "";
$username = "";
$password= "";
$type="";
$grade="";
$errors = array(); 

// connection to the database
$db = mysqli_connect('localhost', 'root', '', 'informationsystem');

//Initially REGISTER USER 
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $grade = mysqli_real_escape_string($db, $_POST['']);



  // form validation: ensure that the form is correctly filled ...
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($type)) { array_push($errors, "type is required"); }



  //check if the user laready exists to avoid duplicates
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // register user if there are no errors in the form
  if (count($errors) == 0) {
    //encrypt the password before saving in the database
  	$password_hashed = md5($password);
    
  	$query = "INSERT INTO users (name,username, email, password,type) 
          VALUES('$name','$username', '$email', '$password_hashed','$type')";

          $query1= "INSERT INTO students (username,grade)
           VALUES ('$username','$grade')";
         
                
    mysqli_query($db, $query);
    if ($type === "Student"){
    mysqli_query($db, $query1); 
  }
  
  	$_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    if ($type === "Student"){
    header('location: student.php');}
   else if ($type === "TA"){
      header('location: teachingassistant.php');}
     else if ($type === "Lecturer"){
        header('location: lecturer.php');}
  }
}
  // LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $type = mysqli_real_escape_string($db, $_POST['type']);

  if (empty($username)) {
      array_push($errors, "Username is required");
  }
  if (empty($password)) {
      array_push($errors, "Password is required");
  }
  if (empty($type)) {
    array_push($errors, "Type is required");
}
if (count($errors) == 0) {
  
    $password = md5($password);
    $query = "SELECT password  FROM users WHERE username='$username'";
    $results = mysqli_query($db, $query);
    $password2 = mysqli_fetch_assoc($results);

  if ($password2['password'] === $password) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      $query_type = "SELECT type  FROM users WHERE username='$username'";
      $results1 = mysqli_query($db, $query_type);
      $type_12 = mysqli_fetch_assoc($results1);

      if ($type === $type_12['type'] && $type == 'Student'){
        header('location: student.php');
        echo("you are in");}
       else if ($type === $type_12['type'] && $type == 'TA'){
          header('location: teachingassistant.php');
          echo("you are in");
        }
         else if ($type === $type_12['type'] && $type == 'Lecturer'){
            header('location: lecturer.php');
            echo("you are in");
          }
else {
        array_push($errors, "Wrong username/password and type combination");
    }
  }
}
}

if (isset($_POST['Edit_Grade'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $grade = mysqli_real_escape_string($db, $_POST['grade']);
  $query_grade = "Update students set grade = $grade WHERE username='$username'";
  $results = mysqli_query($db, $query_grade);
}



