<?php include('config.php'); ?>
<?php include('includes/registration_login.php'); ?>
<?php include('includes/header.php'); ?>

  <title>Register</title>
</head>
<body>
  <div class="container">
    <form action="register.php" method="post" class="login-register__form">
      <h1 class="page-header">Register</h1>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <input type="text" name="username" value="<?php echo $username; ?>" placeholder=" username" class="input">
      <input type="password" name="password1" placeholder=" password" class="input">
      <input type="password" name="password2" placeholder=" confirm password" class="input">
      <button type="submit" class="button" name="register-user">Register</button>
      <p>
        Already a member? <a href="login.php" class="links">Log In</a>
      </p>
    </form>
  </div>
</body>
</html>
