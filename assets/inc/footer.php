<?PHP /* The HTML structure of the footer as well as including the javascript files */ ?>
<section class="footer pv50">
  <div class="container text-center-touch animate fadeIn">
    <div class="flexy mb30">
      <div class="flexy-item">
        <p class="mb0"><?php echo $phonelink; ?></p>
        <a href="" target="_blank" rel="noopener"><p><?php echo $street; ?>, <br /> <?php echo $city . " " . $state . " " . $zip; ?> </p></a>
      </div>
      <div class="flexy-item text-center">
        <a href="/"><img src="/assets/img/logo.svg" alt=" <?php echo $sitename; ?> Logo" /></a>
      </div>
      <div class="flexy-item">
        <p class="text-right-desktop"><?php echo $hours; ?></p>
      </div>
    </div>

    <hr class="mb30" style="background-color: #C8C8C8;" />

    <div class="flexy is-vcentered">
      <div class="flexy-item is-35">
        <a href=""><?php ratingstars(4.25, 420); ?></a>
      </div>
      <div class="flexy-item is-30 text-center">
        <div class="socials">
          <a href=""><img src="/assets/img/_defaults/social-instagram.svg" alt=""></a>
          <a href=""><img src="/assets/img/_defaults/social-facebook.svg" alt=""></a>
        </div>
      </div>
      <div class="flexy-item is-35">
        <p class="text-right-desktop micro"><a class="influx-link" href="https://www.influxmarketing.com" target="_blank" rel="noopener"><img src="/assets/img/_defaults/logo-influx-black.svg" alt="Influx Marketing Logo"> <span>Plastic Surgeon Marketing</span></a></p>
      </div>
    </div>

    <p class="footer-links text-center">© <?php echo date("Y"); ?> <?php echo $sitename; ?> &nbsp;&nbsp;|&nbsp;&nbsp; All Rights Reserved &nbsp;&nbsp;|&nbsp;&nbsp; <a href="/privacy-policy/">Privacy Policy</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="/ada/">Accessibility</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="/no-surprises-act/">No Surprises Act</a></p>

    
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/js.php" ?>

</body>

</html>