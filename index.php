<?php
$base="https://reqres.in";
$task1="/api/users";
$page=2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script>
  $(function(){
    $("#tableData").dataTable();
  })
</script>
    <title>Virtual Analyticas</title>
</head>
<body style="margin-left:20%; margin-right:20%">
    <center><h1>Virtual Analytics Task</h1></center>
    <h3>BASE URL -> https://reqres.in/</h3>
    <hr>
    <b><h2>Task 1</h2></b>
    <h3>1. LIST USERS (GET)</h3><br>
    <p>Request -> /api/users</br>
Data Format -> JSON || Parameters -> {key=”page”, value=2},
Fetch the result and display it in jQuery data table.<br>
<?php



?>
</p>
<table id="tableData">
    <thead>
      <tr><th>id</th><th>Image</th><th>Name</th><th>Email</th></tr>
    </thead>
    <tbody>   
      <?php
$json = file_get_contents($base.$task1."?page=".$page);
$json = json_decode($json);
$num=count($json->data);
for($i=0;$i<$num;$i++){
    $vals=$json->data[$i];
    echo "<tr><td>".$vals->id."</td><td><img src='".$vals->avatar."'  height='90px' width='90px'></td><td>".$vals->first_name." ".$vals->last_name."</td><td>".$vals->last_name."</td></tr>";
}

?>
    </tbody>
  </table>
  <br>
  <br>
  <hr>
  <b><h2>Task 2</h2></b>
    <h3>CREATE USER (POST)</h3><br>
  <p>  Request -> /api/users<br>
Date Format -> JSON || Parameters -> {key=”name”, value=”Morpheus”}, {key=”job”, value=”leader”},<br>
Display appropriate result in an alert dialog.
<form method="post" action="">
    <label>Name</label>
    <input type="text" class="form-control" name="name"><br>
    <label >Job</label>
    <input type="text" class="form-control"  name="job"><br>
    <input type="submit" name="submit" class="btn-primary btn">
</form>
<?php
if (isset($_POST['submit'])) {
    $t2="/api/users";
    $name=$_POST['name'];
    $job=$_POST['job'];
    $postData=array(
'name'=> $name,
'job'=>$job,
);
    $ch = curl_init($base.$t2);
    curl_setopt_array($ch, array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => json_encode($postData)
));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
    }
    $responseData = json_decode($response, true);
    echo "<script>alert('User is Created The ID: ".$responseData['id'];
    echo  " Created Date and Time: ".$responseData['createdAt']."');</script>";
}
?>
<br>
<br>
<hr>
<br>
<br>
<b><h2>Task 3</h2></b>
<p>UPDATE USER (PUT)<br>
    Request -> /api/users/2<br>
Date Format -> JSON || Parameters -> {key=”name”, value=”Morpheus”}, {key=”job”, value=”leader”},<br>
Display appropriate result in an alert dialog.
<br>
<form method="post" action="">
    <label>Name</label>
    <input type="text" class="form-control" name="names"><br>
    <label >Job</label>
    <input type="text" class="form-control"  name="jobs"><br>
    <input type="submit" name="submitcheck" class="btn-primary btn">
</form>
<?php
if (isset($_POST['submitcheck'])) {
    $t2="/api/users/2";
    $name=$_POST['names'];
    $job=$_POST['jobs'];
    $putdata=array(
'name'=> $name,
'job'=>$job,
);
    $ch = curl_init($base.$t2);
    curl_setopt_array($ch, array(
    CURLOPT_CUSTOMREQUEST=>'PUT',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS=>http_build_query($putdata),
    
));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
    }
 $responseData = json_decode($response, true);
    echo "<script>alert('User is Created The name: ".$responseData['name'];
    echo  " & job: ".$responseData['job']." Updated at Date and Time: ".$responseData['updatedAt']."');</script>";
}
?>
<br>
<br>
<hr>
<br>
<br>
<b><h2>Task 4</h2></b>
<p>REGISTER USER - SUCCESSFUL (POST)<br>
Request -> /api/register<br>
 Date Format -> JSON || Parameters -> {key=”email”, value=”eve.holt@reqres.in”}, {key=”password”, value=”pistol”},<br>

Display appropriate result in an alert dialog.

<br>
<h3>Register Successfully</h3>
<br>
<form method="post" action="">
    <label>Email</label>
    <input type="text" class="form-control" name="email"><br>
    <label >Password</label>
    <input type="text" class="form-control" name="password"><br>
    <input type="submit" name="register" class="btn-primary btn">
</form>
<?php
if (isset($_POST['register'])){
    $t3="/api/register";
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $postData=array(
'email'=> $email,
'password'=>$pass,
);
    $ch = curl_init($base.$t3);
    curl_setopt_array($ch, array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER=>array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
        echo $ch;
    }
    $responseData = json_decode($response, true);

    echo "<script>alert('User is Registered Successfully The ID: ".$responseData['id'];
    echo  " The Token is :".$responseData['token']." ');</script>";
}
?>
<br>
<br>
<hr>
<b><h2>Task 5</h2></b>
<p>REGISTER USER - UNSUCCESSFUL (POST)<br>
Request -> /api/register<br>
 Date Format -> JSON || Parameters -> {key=”email”, value=”eve.holt@reqres.in”},<br>

Display appropriate result in an alert dialog.
<br>
<h3>Register Unsuccessful</h3>
<br>
<form method="post" action="">
    <label>Email</label>
    <input type="text" class="form-control" name="email1"><br>
    <label >Password</label>
    <input type="text" class="form-control" name="password1" disabled><br>
    <input type="submit" name="registerunsuccess" class="btn-primary btn">
</form>
<?php
if (isset($_POST['registerunsuccess'])){
    $t3="/api/register";
    $email=$_POST['email1'];
    $postData=array(
'email'=> $email,
);
    $ch = curl_init($base.$t3);
    curl_setopt_array($ch, array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER=>array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
        echo $ch;
    }
    $responseData = json_decode($response, true);
    echo "<script>alert('User is Registered unsccessful Error is ".$responseData['error'];
    echo  " ');</script>";
}
?>
<br>
<br>
<hr>
<br>
<br>
<hr>
<b><h2>Task 6</h2></b>
<p>LOGIN USER - SUCCESSFUL (POST)<br>
Request -> /api/login<br>
 Date Format -> JSON || Parameters -> {key=”email”, value=”eve.holt@reqres.in”},
{key=”password”, value=”pistol”},<br>

Display appropriate result in an alert dialog.
<br>
<h3>Login Successful</h3>
<br>
<form method="post" action="">
    <label>Email</label>
    <input type="text" class="form-control" name="email2"><br>
    <label >Password</label>
    <input type="password" class="form-control" name="password2" ><br>
    <input type="submit" name="login" class="btn-primary btn">
</form>
<?php
if (isset($_POST['login'])){
    $t6="/api/login";
    $email=$_POST['email2'];
    $pass=$_POST['password2'];
    $postData=array(
'email'=> $email,
'password'=>$pass
);
    $ch = curl_init($base.$t6);
    curl_setopt_array($ch, array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER=>array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
        echo $ch;
    }
    $responseData = json_decode($response, true);
    echo "<script>alert('User Login Successful Token is:  ".$responseData['token'];
    echo  " ');</script>";
}
?>
<br>
<br>
<hr>
<b><h2>Task 7</h2></b>
<p> LOGIN USER -UNSUCCESSFUL (POST)<br>
Request -> /api/login<br>
 Date Format -> JSON || Parameters -> {key=”email”, value=”eve.holt@reqres.in”},<br>

Display appropriate result in an alert dialog.
<br>
<h3>Login Unsuccessful</h3>
<br>
<form method="post" action="">
    <label>Email</label>
    <input type="text" class="form-control" name="email3"><br>
    <label >Password</label>
    <input type="text" class="form-control" name="password3" disabled><br>
    <input type="submit" name="loginunsuccess" class="btn-primary btn">
</form>
<br>
<br>
<?php
if (isset($_POST['loginunsuccess'])){
    $t6="/api/login";
    $email=$_POST['email3'];
    $postData=array(
'email'=> $email,
);
    $ch = curl_init($base.$t6);
    curl_setopt_array($ch, array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER=>array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));
    // Send the request
    $response = curl_exec($ch);
    // Check for errors
    if ($response === false) {
        die(curl_error($ch));
        echo $ch;
    }
    $responseData = json_decode($response, true);
    echo "<script>alert('User Login Unsuccessful Error is:  ".$responseData['error'];
    echo  " ');</script>";
}
?>
</body>
</html>