<?php include '../../config/path.php';?>
<?php include PATH_ROOT.'/controllers/CategoryController.php'; ?>
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
                <h1 class="title is-2 has-text-centered">Categories</h1>
                <hr>

                <?php include PATH_ROOT. '/includes/messages.php'; ?>

                <div class="container">

                    <!-- Add Category Form -->
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Add Category</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="container">
                                        <p class="control is-expanded">
                                            <input class="input <?php echo (empty($empty_error) ? "" : "is-danger"); ?>" 
                                                    type="text" placeholder="Title..." name="title"
                                                    value="<?php echo $title; ?>">
                                            <?php 
                                                if (!empty($empty_error)) {
                                                    echo "<p class='help is-danger'>$empty_error</p>";
                                                }
                                            ?>
                                            
                                        </p>
                                    </div>
                                    <p class="control">
                                        <input class="button is-info" type="submit" value="Submit" name="<?php echo $btn_name; ?>">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    
                </div>
                <div class="table-container mt-5">

                    <!-- Categories Table -->
                    <table class="table is-hoverable is-fullwidth has-text-centered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $category['id']; ?></td>
                                    <td><?php echo $category['title']; ?></td>
                                    <td>
                                        <a class="button is-link is-light is-small"
                                            href="index.php?source=edit&id=<?php echo $category['id']; ?>">Edit</a>
                                    </td>
                                    <td>
                                        <a class="button is-danger is-light is-small"
                                            href="index.php?source=delete&id=<?php echo $category['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
