<header>
  <nav role="navigation">
    <div id="menu--control">
      <input type="checkbox"/>
      <span></span>
      <span></span>
      <span></span>
      <ul class="menu" id="menu">
        <li><a href="/">Kezdőlap</a></li>
        <li><a href="/">Képzések</a></li>
        <li><a href="/">Felvételi</a>
        <li><a href="/">Ponthatárok</a></li>
        <?php
        if (empty($_SESSION[SESSION_USER_LOGGED_IN])) {
          echo '
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          ';
        }
        else {
          ?>
          <li><a href="/logout">Kijelentkezés</a></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </nav>
  <div class="hero">
    <h1>Üdvözlünk
      <?php
      if (!empty($_SESSION[SESSION_USER_LOGGED_IN])) {
        echo '<span class="username"> ' . $_SESSION[SESSION_CURRENT_USER_NAME] . '</span>';
      }
      ?>
      to Nobel Középiskola</h1>
    <p>Your Perfect Getaway</p>
  </div>
</header>
