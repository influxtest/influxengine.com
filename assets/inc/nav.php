<section class="header animate fadeIn">
  <nav class="navbar container " role="navigation" aria-label="main navigation">
    <a class="navbar-brand" href="/">
      <img class="navbar__logo" src="/assets/img/logo.svg" alt="<?php echo $sitename; ?> Logo" />
    </a>

    <div class="navbar-links">
      <a class="navbar-link caption" href="tel:<?php echo $phone; ?>" onclick="gtag('event', 'click', {'event_category': 'phone' ,'event_label': 'call'});"><?php echo $phone ?></a>

      <a class="navbar-link caption" href="/consultation/"> Request Consultation<img class="arrow-right white" src="/assets/img/_defaults/arrow-right-white.svg" alt="arrow" /></a>
      <div class="menu-button" aria-label="Menu Button">
        <div>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <label>Menu</label>
      </div>
    </div>
  </nav>

  <menu class="mega-menu container  white" style="--columnCount: 5;">

    <div class="top-menu">
      <ul>
        <li><a class="accent-color" href="/contact/">Contact</a></li>
        <li><a class="accent-color" href="/virtual-consultation/">Virtual Consult</a></li>
        <li><a class="accent-color" href="/consultation/">Consultation</a></li>
        <li><a class="accent-color" href="/testimonials/">Testimonials</a></li>
        <li><a class="accent-color" href="<?php echo $galleryRoot; ?>">Gallery</a></li>

      </ul>
    </div>

    <hr class="mv20" />

    <div class="main-menu">
      <ul>
        <li><a class="accent-color" href="/procedure-category/">Procedure Category</a></li>
        <li><a href="/procedure/">Procedure</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
      </ul>

      <ul>
        <li><a class="accent-color" href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
      </ul>

      <ul>
        <li><a class="accent-color" href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
      </ul>

      <ul>
        <li><a class="accent-color" href="/procedure-supercategory/">Super Category</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>
        <li><a href="/link/">Link</a></li>

        <ul>
          <li><a href="/link/">Link</a></li>
          <li><a href="/link/">Link</a></li>
          <li><a href="/link/">Link</a></li>
        </ul>
      </ul>

      <ul>
        <li><a class="accent-color nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
        <li><a class="nav-top" href="/link/">Link</a></li>
      </ul>
    </div>

  </menu>
</section>

<div class="mobile-cta">
  <a href="tel:<?php echo $phone; ?>" onclick="gtag('event', 'click', {'event_category': 'phone' ,'event_label': 'call'});"><?php echo $phone ?></a>
  <a href="/consultation/"> Appointment</a>
</div>


<div class="overlay">
</div>


<div class="modal">
  <div class="modal-background"></div>
  <div class="modal-content">
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>
