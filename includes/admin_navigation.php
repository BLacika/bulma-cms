<nav
    class="navbar is-primary has-background-primary-dark is-fixed-top"
    role="navigation"
    aria-label="main navigation"
>
    <div class="container">
    <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo BASE_URL ?>">
        <img
        src="https://bulma.io/images/bulma-logo.png"
        width="112"
        height="28"
        />
    </a>

    <a
        role="button"
        class="navbar-burger burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasicExample"
    >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start"></div>

    <div class="navbar-end">
        <a class="navbar-item" href="<?php echo BASE_URL ?>">
        Home
        </a>
        <?php if (isset($_SESSION['id'])): ?>    
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
                <span class="icon is-small is-left">
                <i class="fas fa-user mr-1"></i>
                </span>
                <span><?php echo $_SESSION['username']; ?></span>
            </a>

            <div class="navbar-dropdown is-right">
                <a class="navbar-item has-text-danger"
                    href="<?php echo BASE_URL . '/logout.php' ?>">
                Logout
                </a>
            </div>
        </div>
        <?php endif ?>
    </div>
    </div>
    </div>
</nav>
