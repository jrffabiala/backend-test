<?php include('config.php'); ?>
<?php include('includes/admin_functions.php'); ?>
<?php include('includes/header.php'); ?>

<?php $roles = ['Admin', 'User']; ?>
<?php if(isset($_GET['title'])) {
    $title = $_GET['title'];
    $isEdit = true;
  } else {
    $title = 'Create';
  };
?>

  <title>Manage Users</title>
</head>
<body>
  <div class="container">

    <?php include(ROOT_PATH . '/includes/profile_banner.php') ?>

    <form method="post" action="<?php echo BASE_URL . 'users.php'; ?>" class="login-register__form">

      <h1 class="page-header">
        <?php if($title === 'Edit') : echo $title . ' user' ?>
          <h5>(Fill up all fields to update)</h5>
        <?php else : echo $title . 'user' ?>  
        <?php endif ?>
      </h1>

      <?php include(ROOT_PATH . '/includes/errors.php') ?>

      <?php if ($isEditingUser === true): ?>
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
      <?php endif ?>

      <input type="text" name="username" value="<?php echo $username; ?>" placeholder="username" class="input">
      <input type="password" name="password1" placeholder="password" class="input">
      <input type="password" name="password2" placeholder="password confirmation" class="input">
      <select name="role" class="input">
        <option value="" selected disabled>Assign role</option>
        <?php foreach ($roles as $key => $role): ?>
          <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
        <?php endforeach ?>
      </select>

      <?php if ($isEditingUser === true): ?>
        <input type="submit" value="Update" name="update-user" class="button">
      <?php else: ?>
        <input type="submit" value="Create User" name="create-user" class="button">
      <?php endif ?>
    </form>
  </div>
</body>
</html>
