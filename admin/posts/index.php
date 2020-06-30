<?php include '../../config/path.php';?>
<?php include PATH_ROOT.'/controllers/PostController.php'; ?>
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

                <h1 class="title is-2 has-text-centered">Posts</h1>
                <hr>

                <form action="index.php" method="post" >

                  <div class="field is-horizontal">
                    <div class="control">
                      <div class="select is-primary">
                        <select name="bulk_options">
                          <option value="">Select Options</option>
                          <option value="published">Publish</option>
                          <option value="unpublish">Unpublish</option>
                          <option value="delete">Delete</option>
                          <option value="clone">Clone</option>
                        </select>
                      </div>
                    </div>
                    <div class="field">
                        <div class="control ml-2">
                          <input type="submit"
                                  value="Apply"
                                  class="button is-primary"
                                  name="apply_option" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="control ml-2">
                          <a class="button is-primary" href="create.php">
                            Add new
                          </a>
                        </div>
                    </div>
                  </div>

                  <hr>

                  <?php include PATH_ROOT. '/includes/messages.php'; ?>

                  <div class="container">
                      <div class="table-container mt-5">

                        <!-- Posts Table -->
                        <table class="table is-hoverable is-fullwidth has-text-centered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes" onclick="selectAll(this)"></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Created at</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post): ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkBoxArray[]" id="checkbox"
                                                  value="<?php echo $post['id']; ?>"></td>
                                        <td><?php echo $post['id']; ?></td>
                                        <td><?php echo $post['title']; ?></td>
                                        <td>
                                          <?php 
                                            $post_category_id = $post['category_id'];
                                            $category = selectOne('categories', ['id'=>$post_category_id]);
                                            echo $category['title'];
                                          ?>
                                        </td>
                                        <td>
                                          <?php 
                                            echo $post['status'] ? "publish" : "unpublish";
                                          ?>
                                        </td>
                                        <td>
                                          <?php 
                                            $post_user_id = $post['user_id'];
                                            $user = selectOne('users', ['id'=>$post_user_id]);
                                            echo $user['username'];
                                          ?>
                                        </td>
                                        <td><?php echo $post['created_at']; ?></td>
                                        <td>
                                            <?php 
                                              if ($post['status']) {
                                                $post_id = $post['id'];
                                                 echo "<a class='button is-info is-light is-small'
                                                        href='index.php?source=unpublish&id=$post_id'>Unpublish</a>";
                                              } else {
                                                $post_id = $post['id'];
                                                echo "<a class='button is-info is-light is-small'
                                                        href='index.php?source=publish&id=$post_id'>Publish</a>";
                                              }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="button is-link is-light is-small"
                                                href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a class="button is-danger is-light is-small"
                                                href="edit.php?delete_id=<?php echo $post['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                      </div>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
