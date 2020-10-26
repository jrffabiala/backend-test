<?php include('config.php'); ?>
<?php include('includes/user_functions.php'); ?>
<?php include('includes/header.php'); ?>

<?php $reports = getUserReports(); ?>
  <title> User Reports</title>
</head>
<body>
  <div class="container">

    <?php include(ROOT_PATH . '/includes/profile_banner.php') ?>

    <div class="dashboard-form">
      <h1 class="page-header">User Dashboard</h1>
    </div>
    <div class="reports-table">

      <a href="reports.php" class="links">Add a Report</a>

      <?php if (empty($reports)): ?><span>You have no reports.</span>
      <?php else: ?>
        <table class="table">
          <thead>
            <th></th>
            <th>Report Title</th>
            <th>Report Body</th>
            <th colspan="2">Actions</th>
          </thead>
          <tbody>
          <?php foreach ($reports as $key => $report): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $report['title']; ?></td>
              <td><?php echo $report['body']; ?></td>
              <td>
                <a class="links" href="reports.php?title=Edit&edit-report=<?php echo $report['id']?>">
                  Edit Report
                </a>
              </td>
              <td>
                <a class="links" href="reports.php?delete-report=<?php echo $report['id'] ?>">Delete Report</a>
              </td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      <?php endif ?>
    </div>
  </div>
</body>
</html>


  