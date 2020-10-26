<?php include('config.php'); ?>
<?php include('includes/admin_functions.php'); ?>
<?php include('includes/header.php'); ?>

<?php $users = getUsers(); ?>


  <title>Admin Dashboard</title>
</head>
<body>
  <div class="container">
  
    <?php include(ROOT_PATH . '/includes/profile_banner.php') ?>

    <div class="dashboard-form">
      <h1 class="page-header">Admin Dashboard</h1>
    </div>
    <div class="users-table">

      <a href="users.php" class="links">Add a User</a>

      <?php if (empty($users)): ?><span>No users in the database.</span>
      <?php else: ?>
        <table class="table">
          <thead>
            <th></th>
            <th>User</th>
            <th>Number of Reports</th>
            <th colspan="3">Actions</th>
          </thead>
          <tbody>
          <?php foreach ($users as $key => $user): ?>
            <tr>
              <td><?php echo $key + 1; ?></td>
              <td><?php echo $user['username']; ?></td>
              <td><?php echo $user['number_of_reports']; ?></td>
              <td>
                <a class="links" href="users.php?title=Edit&edit-user=<?php echo $user['id']?>">
                  Edit User
                </a>
              </td>
              <td>
                <a class="links" href="users.php?delete-user=<?php echo $user['id'] ?>">
                  Delete User
                </a>
              </td>
              <td>
                <a class="links" href="view_reports.php?userId=<?php echo $user['id'] ?>">
                  View Reports
                </a>
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
