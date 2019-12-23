<?php include(__DIR__ . '/../../config/database.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<section class="bd-index-fullscreen hero is-fullheight is-light">
  <div class="hero-head">
    <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item" href="/" >
              <img src="<?php echo $ROOT?>public/img/camagru.png" width="112" height="28">
            </a>
            <?php if ($logged === 1) {?><a class="navbar-item" id="username_header" style="pointer-events: none;">Hello <?php echo($_SESSION['user']) ?>!</a><?php } ?>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
          <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
              <?php if ($logged === 1) {?><a class="navbar-item" href="/upload">Share picture</a><?php } ?>
            </div>
            <div class="navbar-end">
              <div class="navbar-item">
                <div class="buttons">
                    <?php if ($logged === 1) {?>
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
      </div>
  </div>

<script src="<?php echo $ROOT ?>public/js/navbar.js"></script>

<div class="hero-body">
    <div class="container">
      <body class="bd-index-header">