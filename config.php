<?php
    session_start();

    $conn = mysqli_connect(<hostname>, <username>, <pw>, <dbname>);

    if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

    // global variables
    define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://localhost/backend-test/'); // base_url e.g. 'http://localhost/backend-test'
?>