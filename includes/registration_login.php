<?php
  $username = "";
  $errors = array();

  // register
  if (isset($_POST['register-user'])) {

    $username = esc($_POST['username']);
    $password1 = esc($_POST['password1']);
    $password2 = esc($_POST['password2']);

    // form validation
		if (empty($username)) {  array_push($errors, "Username should not be empty."); }
		if (empty($password1)) { array_push($errors, "Password should not be empty."); }
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
			$query = "INSERT INTO users (username, password) 
					  VALUES('$username', '$password')";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			$_SESSION['user'] = getUserById($reg_user_id);

			if ( in_array($_SESSION['user']['role'], ["Admin"])) {
				$_SESSION['message'] = "You are now logged in";
				// redirect to admin area
				header('location: ' . BASE_URL . 'admin_dashboard.php');
				exit(0);
			} else {

				header('location: user_dashboard.php');				
				exit(0);
			}
    }
  }
    
  // login
  if (isset($_POST['login-user'])) {
    $username = esc($_POST['username']);
    $password = esc($_POST['password']);

    if (empty($username)) { array_push($errors, "Username required"); }
    if (empty($password)) { array_push($errors, "Password required"); }
    
    if (count($errors) == 0) {
      $password = md5($password);
      $sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        // get id of created user
        $reg_user_id = mysqli_fetch_assoc($result)['id']; 

        // put logged in user into session array
        $_SESSION['user'] = getUserById($reg_user_id); 

        
        if ( in_array($_SESSION['user']['role'], ["Admin"])) {
          $_SESSION['message'] = "You are now logged in";
          
          header('location: ' . BASE_URL . 'admin_dashboard.php');
          exit(0);
        } else {
          $_SESSION['message'] = "You are now logged in";
          
          header('location: ' . BASE_URL . 'user_dashboard.php');	
          exit(0);
        }
      } else {
        array_push($errors, 'Wrong credentials');
      }
    }
  }

  // helper function
  function esc(String $value) {	
    
    global $conn;

    $val = trim($value);
    $val = mysqli_real_escape_string($conn, $value);

    return $val;
  }

  // Get user info from user id
  function getUserById($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // returns user in an array format: 
    // ['id'=>1 'username' => 'Awa', 'password'=> 'mypass']
    return $user; 
  }
?>