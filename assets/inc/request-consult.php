<?php /* this is designed to include some fluff and the basic contact form */ ?>
<section class="pv100 box-shadow-smooth bg-image animate zoomOutBg" style="--bgImage: url(/assets/img/bg/default.jpg);">
  <div class="container">
    <div class="mw1600">
      <div class="inline-schedule-consult">
        <div class="flexy gap100 block-desktop is-vcentered">
          <div class="flexy-item animate fadeIn">
            <h2 class="ipj-link mb40 title-md white" id="ipj-consult" data-ipj="Consultation">Adipisicing velit proident.</h2>
            <a href=""><p class="lead white"><?php echo $address; ?></p></a>
            <p class="white">Aliqua sit enim nostrud sit culpa veniam proident adipisicing amet nisi ipsum. Amet quis duis est deserunt do non qui cupidatat in incididunt laboris do irure adipisicing. Ad sit sit fugiat veniam pariatur Lorem eiusmod minim ex quis mollit. Minim Lorem adipisicing laborum proident velit non commodo aute cupidatat exercitation pariatur. Amet magna elit fugiat esse anim cupidatat proident officia cillum eiusmod. Esse minim veniam ullamco culpa minim excepteur.</p>
          </div>
          <div class="flexy-item animate fadeIn">
            <div class="contact-form"><?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/form.php" ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
