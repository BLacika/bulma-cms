<?php include '../config/path.php';?>
<?php include PATH_ROOT.'/controllers/PostController.php'; ?>
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
                <h1 class="title is-2 has-text-centered">Dashboard</h1>
                <hr>

                <?php include PATH_ROOT. '/includes/messages.php';?>

                <div class="container">

                    
                    
                </div>
            </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php include PATH_ROOT.'/includes/admin_footer.php'; ?>
