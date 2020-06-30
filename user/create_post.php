<?php 
include '../config/path.php';
include PATH_ROOT.'/controllers/ProfileController.php';
?>
<?php usersOnly(); ?>
<?php include PATH_ROOT. '/includes/header.php';?>

    <!-- Navigation -->
    <?php include PATH_ROOT. '/includes/navigation.php';?>

    <!--Page Content-->
    <section class="section mt-5" id="site-content">

      <?php include PATH_ROOT. '/includes/messages.php';?>

      <div class="columns">
        <div class="column is-8 is-offset-2">

          <div class="title has-text-centered">Create Post</div>

          <div class="card">

            <div class="card-content">
              <form action="create_post.php" method="post" enctype="multipart/form-data">

                        <?php include PATH_ROOT.'/helpers/form_errors.php';?>

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
                                    <span class="file-name"></span>
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
                            <?php if(empty($status)): ?>
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
                                <button class="button is-link" name="create_post">Submit</button>
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
    <?php include PATH_ROOT. '/includes/footer.php';?>
