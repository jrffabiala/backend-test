<?php include('config.php'); ?>
<?php include('includes/admin_functions.php'); ?>
<?php include('includes/header.php'); ?>

<?php $userId = $_GET['userId']; ?>
<?php $reports = getUserReportsById($userId); ?>

  <title>Manage Users</title>
</head>
<body>
<div class="container">
    
    <?php include(ROOT_PATH . '/includes/profile_banner.php') ?>

    <div class="dashboard-form">
      <h1 class="page-header"><?php echo $_SESSION['user']['username']?>'s Reports</h1>
    </div>
    <div class="reports-table">

      <?php if (empty($reports)): ?><span>User has no reports.</span>
      <?php else: ?>
        <table class="table">
          <thead>
            <th></th>
            <th>Report Title</th>
            <th>Report Body</th>
          </thead>
          <tbody>
          <?php foreach ($reports as $key => $report): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $report['title']; ?></td>
              <td><?php echo $report['body']; ?></td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      <?php endif ?>
    </div>
  </div>
</body>
</html>
