<?php 
require_once("../config.php"); 
require_once("class-phpass.php"); 
global $db;

$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if(!$db){
	die( "Sorry! There seems to be a problem connecting to our database.");
}

function login($username, $password){
	global $db; 
	$sql = "SELECT id, password FROM kv_users WHERE username='".$username."' LIMIT 1 ";		
	$result = mysqli_query($db, $sql);
	$id = mysqli_fetch_row($result);
	if($id){
		$password_hashed = $id[1];
		$wp_hasher = new PasswordHash(16, true);
		if($wp_hasher->CheckPassword($password, $password_hashed)) {
			return $id[0];
		}
	} else {
		return false;
	}
}

function usernameExist($username){
	global $db; 
	$sql = "SELECT id FROM kv_users WHERE username='".$username."' LIMIT 1 ";		
	$result = mysqli_query($db, $sql);
	$id = mysqli_fetch_row($result);
	if($id[0] > 0){
		return true;
	}else{
		return false;
	}
}
function register($full_name, $username, $password, $email){
	global $db; 
	$wp_hasher = new PasswordHash(16, true);
			$pass = $wp_hasher->HashPassword( trim( $password ) );
			
	$sql = "INSERT INTO kv_users (full_name, email,password,username) VALUES ('".$full_name."', '".$email."', '".$pass."', '".$username."') ";		
	$result = mysqli_query($db, $sql);
	return  mysqli_insert_id($db);
}

function logout(){
	unset($_SESSION['user_id']);
	session_destroy();	
	header('Location: index.php');
	exit();
}

//mysqli_close($db);