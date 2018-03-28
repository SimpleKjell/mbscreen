<header>
  <div class="navbar h-100">
    <div class="container d-flex justify-content-between">
      <a href="/" class="nav-link d-flex align-items-center {{ Request::is('/') ? 'active' : '' }}">
        <strong>Kampagnen</strong>
      </a>
      <a href="/mediabrothers" class="nav-link d-flex align-items-center {{ Request::path() == 'mediabrothers' ? 'active' : '' }}">
        <strong>Mediabrothers Feed</strong>
      </a>
      <a href="/social-news" class="nav-link d-flex align-items-center {{ Request::path() == 'social-news' ? 'active' : '' }}">
        <strong>Socialmedia News</strong>
      </a>
      <a href="/aktuell" class="nav-link d-flex align-items-center {{ Request::path() == 'aktuell' ? 'active' : '' }}">
        <strong>Live</strong>
      </a>
      <a href="/" class="nav-link d-flex align-items-center mb-tv-logo">
        <img src="/storage/images/mbtv_logo.png" alt="">
      </a>

    </div>
  </div>
</header>
