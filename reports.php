<?php include('config.php'); ?>
<?php include('includes/user_functions.php'); ?>
<?php include('includes/header.php'); ?>
<?php if(isset($_GET['title'])) {
    $title = $_GET['title'];
    $isEdit = true;
  } else {
    $title = 'Create';
  };
?>

  <title>Manage Reports</title>
</head>
<body>
  <div class="container">

    <?php include(ROOT_PATH . '/includes/profile_banner.php') ?>

    <form method="post" action="<?php echo BASE_URL . 'reports.php'; ?>" class="login-register__form">

      <h1 class="page-header">
        <?php if($title === 'Edit') : echo $title . ' reports' ?>
          <h5>(Fill up all fields to update)</h5>
        <?php else : echo $title . ' report' ?>  
        <?php endif ?>
      </h1>

      <?php include(ROOT_PATH . '/includes/errors.php') ?>

      <?php if ($isEditingReport === true): ?>
        <input type="hidden" name="reportId" value="<?php echo $reportId; ?>">
      <?php endif ?>

      <input type="text" name="report_title" value="<?php echo $reportTitle; ?>" placeholder=" report title" class="input">
      <input type="text" name="report_body" value="<?php echo $reportBody; ?>" placeholder=" report body" class="input">

      <?php if ($isEditingReport === true): ?>
        <button type="submit" name="update-report" class="button">Update Report</button>
      <?php else: ?>
        <button type="submit" name="create-report" class="button">Create Report</button>
      <?php endif ?>
    </form>
  </div>
</body>
</html>
