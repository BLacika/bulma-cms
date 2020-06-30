<?php include '../../config/path.php';?>
<?php include PATH_ROOT.'/controllers/UserController.php'; ?>
<?php adminOnly(); ?>
<?php include PATH_ROOT.'/includes/admin_header.php'; ?>

    <!--Navbar-->
    <?php include PATH_ROOT.'/includes/admin_navigation.php';?>

    <!--Page Content-->
    <section class="section mt-5">
      <div class="columns">
        <div class="column is-one-quarter">
            <!-- Admin Sidebar -->
          <?php include PATH_ROOT.'/includes/admin_sidebar.php'; ?>
        </div>
        <!-- Admin Content -->
        <div class="column">
            <div class="container-fluid">
                <h1 class="title is-2 has-text-centered">Edit User</h1>
                <hr>

                <?php include PATH_ROOT.'/helpers/form_errors.php';?>

                <div class="container">

                    <!-- Edit User Form -->
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control">
                                <input class="input" type="text" name="username" value="<?php echo $username; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Firstname</label>
                            <div class="control">
                                <input class="input" type="text" name="firstname" value="<?php echo $firstname; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Lastname</label>
                            <div class="control">
                                <input class="input" type="text" name="lastname" value="<?php echo $lastname; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" name="password" value="<?php echo $password; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Confirm Password</label>
                            <div class="control">
                                <input class="input" type="password" name="confirm_password">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Role</label>
                            <div class="control">
                                <div class="select">
                                <select name="role">
                                    <?php if($role === 'admin'): ?>
                                        <option selected value="admin">Admin</option>
                                        <option value="user">User</option>
                                    <?php else: ?>
                                        <option selected value="user">User</option>
                                        <option value="admin">Admin</option>
                                    <?php endif; ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="field">
                            <div class="control">
                                <button class="button is-link" name="update_user">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
