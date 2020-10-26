<?php

$reportId = 0;
$userId = $_SESSION['user']['id'];
$isEditingReport = false;
$reportTitle = "";
$reportBody = "";

$errors = [];

if (isset($_POST['create-report'])) {
	createReport($_POST);
}

if (isset($_GET['edit-report'])) {
	$isEditingReport = true;
	$reportId = $_GET['edit-report'];
	editReport($reportId);
}

if (isset($_POST['update-report'])) {
	updateReport($_POST);
}

if (isset($_GET['delete-report'])) {
	$reportId = $_GET['delete-report'];
	deleteReport($reportId);
}

function getUserReports() {
  global $conn;

  $userId = $_SESSION['user']['id'];
  $sql = "SELECT * FROM reports WHERE user_id=$userId";

  $result = mysqli_query($conn, $sql);
  $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $reports;
}

function createReport($request_values) {
  global $conn, $errors, $userId, $reportTitle, $reportBody;

  $reportTitle = esc($request_values['report_title']);
  $reportBody = esc($request_values['report_body']);

  if (empty($reportTitle)) {  array_push($errors, "Report Title should not be empty."); }
  if (empty($reportBody)) { array_push($errors, "Report Body should not be empty."); }
  
  if (count($errors) == 0) {
		$query = "INSERT INTO reports (user_id, title, body) 
				  VALUES($userId, '$reportTitle', '$reportBody')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: user_dashboard.php');
		exit(0);
	}
}

function editReport($reportId)
{
	global $conn, $userId, $reportTitle, $reportBody;

	$sql = "SELECT * FROM reports WHERE id=$reportId LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$report = mysqli_fetch_assoc($result);

  $reportTitle = $report['title'];
  $reportBody = $report['body'];
}

function updateReport($request_values){
	global $conn, $errors, $userId, $isEditingUser, $reportBody, $reportTitle, $reportId;
	
	$reportId = $request_values['reportId'];
	
	$isEditingReport = false;

  $reportTitle = esc($request_values['report_title']);
	$reportBody = esc($request_values['report_body']);

	if (count($errors) == 0) {

		$query = "UPDATE reports SET user_id=$userId, title='$reportTitle', body='$reportBody' WHERE id=$reportId";
		mysqli_query($conn, $query);

		header('location: user_dashboard.php');
		exit(0);
	}
}

function deleteReport($reportId) {
	global $conn;
	$sql = "DELETE FROM reports WHERE id=$reportId";
	if (mysqli_query($conn, $sql)) {
		header("location: user_dashboard.php");
		exit(0);
	}
}

// helper function
function esc(String $value) {	
  global $conn;

  $val = trim($value);
  $val = mysqli_real_escape_string($conn, $value);

  return $val;
}

?>