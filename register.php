<?php include 'config/path.php';?>
<?php include PATH_ROOT.'/controllers/UserController.php';?>
<?php guestsOnly(); ?>

<?php include PATH_ROOT. '/includes/header.php';?>

<!-- Navigation -->
<?php include PATH_ROOT. '/includes/navigation.php';?>


<section class="section is-medium register" id="site-content">
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="container">
                <h1 class="title has-text-centered">Registration</h1>

                <?php include PATH_ROOT.'/helpers/form_errors.php';?>

                <form action="register.php" method="post">
                    <div class="field">
                        <label class="label">Username</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class='input' type='text' name='username' placeholder='Username' 
                                        value="<?php echo $username; ?>">
                            
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" 
                                    type="email" placeholder="email@email.com" name="email" 
                                    value="<?php echo $email; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" 
                                    type="password" placeholder="Password" name="password" 
                                    value="<?php echo $password; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Confirm Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" 
                                    type="password" placeholder="Confirm Password"
                                    name="confirm_password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button class="button is-link is-fullwidth" name="register_user">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include PATH_ROOT. '/includes/footer.php';?>
