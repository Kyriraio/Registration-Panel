<?php
require_once 'db_connect.php';
session_start();

$errors=array();

$login=trim($_POST['login']);
$password=trim($_POST['password']);
$cpassword=trim($_POST['cpassword']);
$email=trim($_POST['email']);

htmlentities($login, ENT_QUOTES, 'UTF-8');
htmlentities($password, ENT_QUOTES, 'UTF-8');
htmlentities($email, ENT_QUOTES, 'UTF-8');


if($login==""){
    $errors=array_merge($errors,array('login'=>'Please enter your login'));
} elseif (strlen($login)<3){
    $errors=array_merge($errors,array('login'=>'Your login must contain at least 3 characters'));
} elseif (strpos($login,' ')){
    $errors=array_merge($errors,array('login'=>'Your login must not contain spaces'));
}

if($password==""){
    $errors=array_merge($errors,array('password'=>'Please enter your password'));
} elseif ($cpassword==""){
    $errors=array_merge($errors,array('password'=>'Please enter password confirmation'));
} elseif (strlen($password)<8){
    $errors=array_merge($errors,array('password'=>'Your password must contain at least 8 characters'));
} elseif (strpos($password,' ')){
    $errors=array_merge($errors,array('password'=>'Your password must not contain spaces'));
} elseif ($password!=$cpassword){
    $errors=array_merge($errors,array('password'=>'Your passwords mismatch'));
}

if($email==""){
    $errors=array_merge($errors,array('email'=>'Please enter your email'));
} elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors=array_merge($errors,array('email'=>'Your email is incorrect'));
} 


$sql="SELECT id FROM USER WHERE login=:ulogin OR email=:umail";
$stmt=$conn->prepare($sql);
$stmt->execute([
    'ulogin'=>$login,
    'umail'=>$email
  ]);

  if($stmt->fetch())
  {
    $errors=array_merge($errors,array('email'=>'This login or email is already in use'));
  }
  
if(!$errors){
//$salt=randomSalt();
$pepper='huii';

$password=password_hash($password.$pepper,PASSWORD_ARGON2ID);

$sql="INSERT INTO USER (login, password, email, session_id) VALUES (:ulogin, :upass, :umail, :usession_id)";
$stmt=$conn->prepare($sql);
$stmt->execute([
    'ulogin'=>$login,
    'upass'=>$password,
    'umail'=>$email,
    'usession_id'=>session_id()
]);

setcookie(session_name(), session_id(), strtotime("+10 years"));
$_SESSION['login']=$login;
$_SESSION['email']=$email;
}

echo json_encode($errors);

function randomSalt($len = 8) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
	$l = strlen($chars) - 1;
	$str = '';
	for ($i = 0; $i<$len; ++$i) {
		$str .= $chars[rand(0, $l)];
 	}
	return $str;
}