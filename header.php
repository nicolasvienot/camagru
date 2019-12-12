<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<?php
  session_start();
  if (isset($_SESSION['user_logged']) || $_SESSION['user_logged'] != "") {
?>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo 'index.php' ?>" >
      <img src="/camagru.png" width="112" height="28">
    </a>
    <a class="navbar-item">
      Bonjour <?php print ($_SESSION['user_logged']) ?>!
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Social wall
      </a>
      <a class="navbar-item">
        Upload image
      </a>
      <!-- <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>
        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div> -->
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Modify account</strong>
          </a>
          <a class="button is-light">
            Log out
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

<?php
  }
  else {
?>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo 'index.php' ?>">
      <img src="/camagru.png" width="112" height="28">
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Social wall
      </a>
      <!-- <a class="navbar-item">
        Add image
      </a> -->
      <!-- <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>
        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div> -->
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="<?php echo 'create_account.php' ?>">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="<?php echo 'login.php' ?>">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

<?php
  }
?>

<script>

document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});

</script>

</html>