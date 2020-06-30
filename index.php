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

            <div class="title has-text-centered"><?php echo $post_title; ?></div>

            <?php foreach ($posts as $key => $post): ?>

            <!-- Blog Post -->
            <div class="card mb-5">
              <div class="card-header">
                <div class="card-header-title">
                  <a href="post.php?id=<?php echo $post['id']; ?>">
                    <div class="title"><?php echo $post['title']; ?></div>
                    <div class="subtitle">
                      <?php 
                        $category = selectOne('categories', ['id'=>$post['category_id']]);
                        echo $category['title'];
                      ?>
                    </div>
                  </a>
                </div>
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
              <div class="card-content">
                <div class="media">
                  <div class="media-left">
                    <figure class="image is-48x48">
                      <img
                        src="https://bulma.io/images/placeholders/96x96.png"
                        alt="Placeholder image"
                      />
                    </figure>
                  </div>
                  <div class="media-content">
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
                      <time datetime="<?php echo $post['created_at']?>"><?php echo $post['created_at']?></time>
                  </div>
                </div>

                <div class="content">
                  <div>
                    <?php echo html_entity_decode(substr($post['content'], 0, 150) . "..."); ?>
                  </div>
                  <br>
                  Tags: <?php 
                      $tags = explode(',', $post['tags']);
                      foreach ($tags as $tag) {
                        echo "<span class='tag is-link'>$tag</span>";
                      }
                    ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            
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
                      <input type="text" class="input is-primary" 
                             name="search_post" placeholder="Search...">
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
