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

          <div class="title has-text-centered">Welcome back <?php echo $user['username'] ?>!</div>

          <div class="card">
            
            <header class="card-header">
              <div class="container">
                <div class="columns mt-2 mb-2">
                  <div class="column is-2 is-offset-5">
                    <figure class="image is-128x128">
                      <img id="profile-pic" src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                  </div>
                </div>
              </div>
            </header> 

            <div class="card-content">
              <div class="columns">
                <div class="column has-text-left is-2">
                  <h4 class="title is-4">Username:</h4>
                </div>
                <div class="column">
                  <h4 class="subtitle is-4"><?php echo $user['username']; ?></h4>
                </div>
              </div>

              <div class="columns">
                <div class="column has-text-left is-2">
                  <h4 class="title is-4">Full name:</h4>
                </div>
                <div class="column">
                  <h4 class="subtitle is-4"><?php echo $user['firstname'] . " " . $user['lastname']; ?></h4>
                </div>
              </div>

              <div class="columns">
                <div class="column has-text-left is-2">
                  <h4 class="title is-4">Email:</h4>
                </div>
                <div class="column">
                  <h4 class="subtitle is-4"><?php echo $user['email']; ?></h4>
                </div>
              </div>
            </div>

            <footer class="card-footer">
              <a href="posts.php" class="card-footer-item">Posts</a>
              <a href="edit_profile.php" class="card-footer-item">Edit profile</a>
              <a href="index.php?source=delete_profile" 
                  class="card-footer-item"
                  onclick="javascript: return confirm('Are you sure you want to delete?'); " 
                  >Delete profile</a>
            </footer>

          </div>
          
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include PATH_ROOT. '/includes/footer.php';?>
