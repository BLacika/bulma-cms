<?php include '../../config/path.php';?>
<?php include PATH_ROOT.'/controllers/PostController.php'; ?>
<?php include PATH_ROOT.'/includes/admin_header.php'; ?>
<?php adminOnly(); ?>

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
                <h1 class="title is-2 has-text-centered">Add Post</h1>
                <hr>

                <?php include PATH_ROOT.'/helpers/form_errors.php';?>

                <div class="container">

                    <!-- Add Post Form -->
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="field">
                            <label class="label">Title</label>
                            <div class="control">
                                <input class="input" type="text" name="title" value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Category</label>
                            <div class="control">
                                <div class="select">
                                <select name="category_id">
                                    <option value="">Choose a Category...</option>
                                    <?php foreach ($categories as $category): ?>
                                        <?php if(!empty($category_id) && $category_id == $category['id']): ?>
                                            <option selected value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Image</label>
                            <figure class="image is-fullwidth">
                                <img src="../../assets/images/<?php echo $image_name; ?>">
                            </figure>
                            <div class="file has-name is-fullwidth" id="post-image-upload">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image" oninput="showFileName()">
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                    </span>
                                    <span class="file-name"><?php echo $image_name; ?></span>
                                </label>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Tags</label>
                            <div class="control">
                                <input class="input" type="text" name="tags" value="<?php echo $tags; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Content</label>
                            <div class="control">
                                <textarea class="textarea" name="content" 
                                        id="ckeditor" cols="30" rows="10"><?php echo $content; ?></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <?php if(empty($status) && $status == 0): ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="status">
                                    Published
                                </label>
                            <?php else: ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="status" checked>
                                    Published
                                </label>
                            <?php endif; ?>
                            
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-link" name="update_post">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>

    <script>
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ) )
            .then(editor => {
                editor.ui.view.editable.editableElement.style.height = '300px';
            })
            .catch( error => {
                console.error( error );
            } );
    </script>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
