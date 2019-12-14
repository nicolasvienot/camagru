<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<section class="bd-index-fullscreen hero is-fullheight is-light">
  <div class="hero-head">
    <div class="container">
      <div class="tabs is-centered">
        <ul>
          <li><a>This is always at the top</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="hero-body">
    <div class="container">
      <header class="bd-index-header">
        <h3 class="title is-3">
          <a href="{{ site.url }}{{ hero_link.path }}">
            <strong>Fullscreen</strong> vertical centering
          </a>
        </h3>
        <h4 class="subtitle is-4">
          Include any content you want, it's always centered
        </h4>
      </header>
    </div>
  </div>

  <div class="hero-foot">
    <div class="container">
      <div class="tabs is-centered">
        <ul>
          <li><a>And this at the bottom</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>