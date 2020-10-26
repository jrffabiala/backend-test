<?php include('config.php'); ?>
<?php include('includes/registration_login.php'); ?>
<?php include('includes/header.php'); ?>
  <title>Log In</title>
</head>
<body>
  <div class="container">
    <form action="login.php" method="post" class="login-register__form">
      <h1 class="page-header">Login</h1>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <input type="text" name="username" value="<?php echo $username; ?>" placeholder=" username" class="input">
      <input type="password" name="password" placeholder=" password" class="input">
      <button type="submit" name="login-user" class="button">Login</button>
      <p>
        Not yet a member? <a href="register.php" class="links">Register</a>
      </p>
    </form>
  </div>
</body>
</html>
