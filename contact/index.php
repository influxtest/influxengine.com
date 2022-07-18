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
      <h1 class="title-xl mb10 white animate fadeIn">Page Title Nathaniel <span class="intro white block animate fadeIn">subtitle</span></h1>

      </div>
      <div class="flexy-item is-40">
        <div class="masthead__image animate fadeIn">
          <img class="animate zoomOut" src="/assets/img/feature/default.jpg" alt="" />
        </div>
      </div>
    </div>
  </div>
</section>

<section class="mv100">
  <div class="container">
    <div class="mw1200">
      <p class="title-md text-center animate fadeIn">Get in touch</p>
      <div class="contact-form contact-page mb100 animate fadeIn" >
          <?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/form.php" ?>
      </div>
    </div>
</section>

<section class="mv100">
  <div class="container ">
   <div class="mw1200">
      <div class="flexy gap100 mw1500">
        <div class="flexy-item animate fadeIn" >
            <h2 class="title-sm mb30">Location</h2>
            <div class="columns">
                <div class="column">
                  <p>
                    <a href="">
                      <?php echo $street; ?><br><?php echo $city; ?>, <?php echo $state; ?> <?php echo $zip; ?>
                    </a>
                  </p>
                  <p class="mb0"><strong>Contact Us</strong></p>
                  <p>Phone :  <?php echo $phonelink; ?></p>
                </div>
            </div>
        </div>
  
        <div class="flexy-item animate fadeIn" >
            <h2 class="title-sm mb30">Our Hours</h2>
            <p>
                Monday: 9:00AM – 5:00PM<br />
                Tuesday: 9:00AM – 5:00PM<br />
                Wednesday: 9:00AM – 5:00PM<br />
                Thursday: 9:00AM – 5:00PM<br />
                Friday: 9:00AM – 2:00PM<br />
                Saturday: 9:00AM – 3:00PM<br />
                Sunday: Closed
            </p>
        </div>
  
       
      </div>
   </div>
  </div>
</section>

<section class="mb100">
  <div class="container">
    <div class="mw1500"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.2488347028802!2d-118.15376568447822!3d34.13997542054841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c37a49086b51%3A0xd587075f43011bf1!2sInflux%20Marketing!5e0!3m2!1sen!2sus!4v1589326942153!5m2!1sen!2sus" width="100%" height="450" frameborder="0" style="border:0;" class="box-shadow-dark" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
      
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/footer.php" ?>

<script>
</script>
