<nav
    class="navbar is-primary has-background-primary-dark is-fixed-top"
    role="navigation"
    aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="<?php echo BASE_URL ?>">
        <img
          src="https://bulma.io/images/bulma-logo.png"
          width="112"
          height="28"/>
      </a>

      <a
        role="button"
        class="navbar-burger burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbar">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbar" class="navbar-menu">
      <div class="navbar-end">
        <a class="navbar-item" href="<?php echo BASE_URL; ?>">
          Home
        </a>

      <?php if(isset($_SESSION["id"])): ?>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            <span class="icon is-small is-left">
                <i class="fas fa-user mr-1"></i>
            </span>
            <span><?php echo $_SESSION["username"]; ?></span>
          </a>

          <div class="navbar-dropdown is-right">
            <?php if(isset($_SESSION["role"])) {
              if ($_SESSION["role"] === "admin") {
                echo "<a class='navbar-item' href='" . BASE_URL . "/admin/dashboard.php'>Dashboard</a>";
                echo "<hr class='navbar-divider'>";
              } else {
                echo "<a class='navbar-item' href='" . BASE_URL . "/user/index.php'>Profile</a>";
                echo "<hr class='navbar-divider'>";
              }
            }
            ?>
            <a class="navbar-item has-text-danger" href="<?php echo BASE_URL . '/logout.php'; ?>">Logout</a>
          </div>
        </div>
      <?php else: ?>
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <a class="button is-primary" href="<?php echo BASE_URL.'/register.php'; ?>">
                <strong>Sign up</strong>
              </a>
              <a class="button is-light" href="<?php echo BASE_URL.'/login.php'; ?>">
                Log in
              </a>
            </div>
          </div>
      </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
