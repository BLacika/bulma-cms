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

          <div class="title has-text-centered">Edit Profile</div>

          <div class="card">

            <?php include PATH_ROOT.'/helpers/form_errors.php';?>
            
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
              <form action="edit_profile.php" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                  <div class="field">
                      <label class="label">Username</label>
                      <div class="control">
                          <input class="input" type="text" name="username" value="<?php echo $user['username']; ?>" disabled>
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Firstname</label>
                      <div class="control">
                          <input class="input" type="text" name="firstname" value="<?php echo $user['firstname']; ?>">
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Lastname</label>
                      <div class="control">
                          <input class="input" type="text" name="lastname" value="<?php echo $user['lastname']; ?>">
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Email</label>
                      <div class="control">
                          <input class="input" type="email" name="email" value="<?php echo $user['email']; ?>">
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Password</label>
                      <div class="control">
                          <input class="input" type="password" name="password" >
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Confirm Password</label>
                      <div class="control">
                          <input class="input" type="password" name="confirm_password">
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
    <?php include PATH_ROOT. '/includes/footer.php';?>
