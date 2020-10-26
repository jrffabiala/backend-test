<?php

$userId = 0;
$isEditingUser = false;
$username = "";
$role = "";

$errors = [];

if (isset($_POST['create-user'])) {
	createUser($_POST);
}

if (isset($_GET['edit-user'])) {
	$isEditingUser = true;
	$userId = $_GET['edit-user'];
	editUser($userId);
}

if (isset($_POST['update-user'])) {
	updateUser($_POST);
}

if (isset($_GET['delete-user'])) {
	$userId = $_GET['delete-user'];
	deleteUser($userId);
}

function getUsers() {
  global $conn, $roles;
  $sql = "SELECT users.*, count(reports.id) as number_of_reports FROM users 
          LEFT OUTER JOIN reports ON (users.id=reports.user_id) 
          WHERE users.role='User' GROUP BY users.id";

  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $users;
}

function createUser($request_values) {
  global $conn, $errors, $role, $username;
  $username = esc($request_values['username']);
  $password1 = esc($request_values['password1']);
  $password2 = esc($request_values['password2']);
  $role = esc($request_values['role']);

  if (empty($username)) {  array_push($errors, "Username should not be empty."); }
  if (empty($password1)) { array_push($errors, "Password should not be empty."); }
  if (empty($role)) { array_push($errors, "Role is required");}
  if ($password1 != $password2) { array_push($errors, "Passwords should match.");}
  
  $check_duplicate_user = "SELECT * FROM users WHERE username='$username' LIMIT 1";

  $result = mysqli_query($conn, $check_duplicate_user);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if (strtolower($user['username']) === strtolower($username)) {
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {
		$password = md5($password1);
		$query = "INSERT INTO users (username, password, role) 
				  VALUES('$username', '$password', '$role' )";
		mysqli_query($conn, $query);

		header('location: admin_dashboard.php');
		exit(0);
	}
}

function editUser($userId)
{
	global $conn, $username, $role, $isEditingUser, $userId;

	$sql = "SELECT * FROM users WHERE id=$userId LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	$username = $user['username'];
}

function updateUser($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $userid;
	
	$userId = $request_values['userId'];
	
	$isEditingUser = false;


	$username = esc($request_values['username']);
  $password1 = esc($request_values['password1']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}

	if (count($errors) == 0) {
		
		$password = md5($password1);

		$query = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$userId";
		mysqli_query($conn, $query);

		header('location: admin_dashboard.php');
		exit(0);
	}
}

function deleteUser($userId) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$userId";
	if (mysqli_query($conn, $sql)) {
		header("location: admin_dashboard.php");
		exit(0);
	}
}

function esc(String $value) {	
  global $conn;

  $val = trim($value);
  $val = mysqli_real_escape_string($conn, $value);

  return $val;
}

function getUserReportsById($userId) {
  global $conn;

  $sql = "SELECT * FROM reports WHERE user_id=$userId";

  $result = mysqli_query($conn, $sql);
  $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $reports;
}

?>