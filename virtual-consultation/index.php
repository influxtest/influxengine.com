<?php
$seotitle = "";
$seodesc = "";
$section = "contact";
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/header.php" ?>

<section class="masthead short bg-image animate zoomOutBg" style="--bgImage: url(/assets/img/masthead/default.jpg);">
  <div class="container pv50">
    <div class="flexy is-vcentered">
      <div class="flexy-item is-60">
        <h1 class="title-xl mb10 white animate fadeIn">Page Title <span class="intro white block animate fadeIn">subtitle</span></h1>
      </div>
      <div class="flexy-item is-40">
        <div class="masthead__image animate fadeIn">
          <img class="animate zoomOut" src="/assets/img/feature/default.jpg" alt="Feature Image"/>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="mv100">
  <div class="container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/logos.php" ?>
  </div>
</section>

<section class="mv100">
  <div class="container">
    <div class="mw1200">
      <p class="intro text-center animate fadeIn mb50">To schedule a virtual consultation at <?php echo $sitename; ?> please fill out our short contact form below, and one of our staff members will reach out to you.</p>
      <div class="contact-form contact-page mb100 animate fadeIn" >
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/form-vc.php" ?>
      </div>
    </div>
</section>


<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/footer.php" ?>

<script>
</script>