<?php
session_start();

// initializing variables
$name = "";
$email    = "";
$username = "";
$password= "";
$type="";
$grade="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'informationsystem');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $grade = mysqli_real_escape_string($db, $_POST['']);



  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($type)) { array_push($errors, "type is required"); }



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$password_hashed = md5($password);//encrypt the password before saving in the database
    
  	$query = "INSERT INTO users (name,username, email, password,type) 
          VALUES('$name','$username', '$email', '$password_hashed','$type')";

          $query1= "INSERT INTO students (username,grade)
           VALUES ('$username','$grade')";
         
        
    //$query1= "INSERT INTO students (username, grade) VALUES ('$username','')";
        
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
  // $password = password_hash($password, PASSWORD_DEFAULT);
    // echo($password);
    //$query = "SELECT * FROM users WHERE username='$username' and type='$type'";
    // echo($password);
    // $res = password_verify("1234", $query);
    // echo($query);
    $password = md5($password);
    $query = "SELECT password  FROM users WHERE username='$username'";
    //$results = mysqli_query($db, $query);
   $results = mysqli_query($db, $query);
   //$query2=mysqli_query($db, $query);
  // $result =mysqli_store_result($results);
    //$password2 = mysqli_use_result($);
  // echo $password2 ;
  $password2 = mysqli_fetch_assoc($results);

//       while ($row = $results->fetch_assoc()) {
//         $password_hashed = $row['password'];
//         // echo($password);
// // $2y$10$6GC.tZSHH.aBIAwzZ3
//       }
  // echo($password_hashed);
//$res = password_verify($password ,$password_hashed);
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



