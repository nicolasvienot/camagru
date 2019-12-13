<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/" >
      <img src="../../public/img/camagru.png" width="112" height="28">
    </a>
    <?php if ($login === 1) {?><a class="navbar-item">Bonjour <?php print ($_SESSION['user_logged']) ?>!</a><?php } ?>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">Social wall</a>
      <?php if ($login === 1) {?><a class="navbar-item">Upload image</a><?php } ?>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <?php if ($login === 1) {?>
                <a class="button is-primary" href="/modifyaccount"><strong>Modify account</strong></a>
                <a class="button is-light" href="/logout">Log out</a>
            <?php } else { ?>
                <a class="button is-primary" href="/signup"><strong>Sign up</strong></a>
                <a class="button is-light" href="/signin">Log in</a>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav>

<script src="../../public/js/navbar.js"></script>

<body>