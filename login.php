<?php include 'config/path.php';?>
<?php include PATH_ROOT. '/includes/header.php';?>
<?php include PATH_ROOT.'/controllers/UserController.php';?>
<?php guestsOnly(); ?>

    <!-- Navigation -->
    <?php include PATH_ROOT. '/includes/navigation.php';?>


    <section class="section is-medium register" id="site-content">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <div class="container">
                    <h1 class="title has-text-centered">Login</h1>

                    <?php include PATH_ROOT.'/helpers/form_errors.php';?>

                    <form action="login.php" method="post">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" placeholder="Username" name="username"
                                        value="<?php echo $username; ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" placeholder="Password" name="password"
                                        autocomplete="off">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link is-fullwidth" name="login_user">Submit</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include PATH_ROOT. '/includes/footer.php';?>
