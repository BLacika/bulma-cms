<?php 
include '../../config/path.php';
include PATH_ROOT.'/controllers/UserController.php';
?>
<?php adminOnly(); ?>

<?php include PATH_ROOT.'/includes/admin_header.php'; ?>

    <!--Navbar-->
    <?php include PATH_ROOT.'/includes/admin_navigation.php';?>

    <!--Page Content-->
    <section class="section mt-5">
      <div class="columns">
        <div class="column is-2">
            <!-- Admin Sidebar -->
          <?php include PATH_ROOT.'/includes/admin_sidebar.php'; ?>
        </div>
        <!-- Admin Content -->
        <div class="column">
            <div class="container-fluid">
                <?php include PATH_ROOT. '/includes/messages.php'; ?>

                <h1 class="title is-2 has-text-centered">Users</h1>
                <hr>

                <?php include PATH_ROOT. '/includes/messages.php'; ?>

                <div class="container">
                    <div class="table-container mt-5">

                      <!-- Posts Table -->
                      <table class="table is-hoverable is-fullwidth has-text-centered">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Username</th>
                                  <th>Firstname</th>
                                  <th>Lastname</th>
                                  <th>Email</th>
                                  <th>Created at</th>
                                  <th>Role</th>
                                  <th colspan="2">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($users as $key => $user): ?>
                                <tr>
                                  <td><?php echo $user['id']; ?></td>
                                  <td><?php echo $user['username']; ?></td>
                                  <td><?php echo $user['firstname']; ?></td>
                                  <td><?php echo $user['lastname']; ?></td>
                                  <td><?php echo $user['email']; ?></td>
                                  <td><?php echo $user['created_at']; ?></td>
                                  <td><?php echo $user['role']; ?></td>
                                  <td>
                                          <a class="button is-link is-light is-small"
                                              href="edit.php?id=<?php echo $user['id'];?>">Edit</a>
                                      </td>
                                      <td>
                                          <a class="button is-danger is-light is-small"
                                              href="edit.php?delete_id=<?php echo $user['id'];?>">Delete</a>
                                      </td>
                                </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
