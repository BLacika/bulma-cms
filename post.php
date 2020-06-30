<?php 
include 'config/path.php';
include PATH_ROOT.'/controllers/HomeController.php';
?>
<?php include PATH_ROOT. '/includes/header.php';?>

    <!-- Navigation -->
    <?php include PATH_ROOT. '/includes/navigation.php';?>

    <!--Page Content-->
    <section class="section mt-5" id="site-content">

    <?php include PATH_ROOT. '/includes/messages.php';?>

      <div class="columns">
        <div class="column is-8">
          <div class="container">

            <div class="title is-2 has-text-centered"><?php echo $post['title']; ?></div>

            <div class="card">
              <div class="card-header">
                <div class="container" id="card-header">
                  <div class="columns">
                    <div class="column">
                      <div class="subtitle is-4">
                        <?php
                        $user = selectOne('users', ['id'=>$post['user_id']]);
                        if (empty($user['firstname']) && empty($user['lastname'])) {
                          echo "<p class='title is-4'>{$user['username']}</p>";
                        } else {
                          $full_name = $user['firstname'] . ' ' .  $user['lastname'];
                          echo "<p class='title is-4'>{$full_name}</p>";
                          echo "<p class='subtitle is-6'>{$user['username']}</p>";
                        }
                        ?>
                      </div>
                    </div>
                    <div class="column has-text-right">
                      <div class="subtitle is-4">
                        <time datetime="<?php echo $post['created_at']?>"><?php echo $post['created_at']?></time>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-content">
                <div class="content">
                  <?php echo html_entity_decode($post['content']); ?>
                </div>
                <div class="card-image">
                  <figure class="image is-fullwidth">
                    <a href="post.php?id=<?php echo $post['id']; ?>">
                      <img
                        src="assets/images/<?php echo $post['image']; ?>"
                        alt="<?php echo $post['image']; ?>"
                      />
                    </a>
                  </figure>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="column">
          <div class="container">
            <!-- Search Widget -->
            <div class="card mb-5">
              <header class="card-header">
                <p class="card-header-title">
                  Search
                </p>
              </header>
              <div class="card-content">
                <form action="index.php" method="post">
                  <div class="field has-addons">
                    <div class="control is-expanded">
                      <input class="input is-primary" type="text" name="search">
                    </div>
                    <div class="control">
                      <button type="submit" class="button is-info" name="search_post"> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- Categories Widget -->
            <?php include PATH_ROOT.'/includes/categories_widget.php';?>

            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include PATH_ROOT. '/includes/footer.php';?>
