<div class="relative">
  <div class="swiper-container box-shadow-smooth animate fadeIn" id="officeSlider"> 
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
      <div class="swiper-slide">
        <img src="/assets/img/masthead/default.jpg" alt="" />
      </div>
    </div>
    <div class="abs bottom left ml50 pb50 z1">
      <div class="swiper-pagination-office lead white"></div>
    </div>
    <div class="office-controls abs bottom right" style="z-index: 1;">
      <div class="swiper-prev-button">
        <img src="/assets/img/_defaults/arrow-left-black.svg" alt="left arrow" />
      </div>
      <div class="swiper-next-button">
        <img src="/assets/img/_defaults/arrow-right-black.svg" alt="right arrow icon" />
      </div>
    </div>
  </div>
</div>

<?php
$js .= <<<EOT
var officeSwiper = new Swiper('#officeSlider', {
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  pagination: {
    el: '.swiper-pagination-office',
    type: 'fraction',
  },
  navigation: {
    prevEl: '.office-controls .swiper-prev-button',
    nextEl: '.office-controls .swiper-next-button',
  },
});
EOT;

?>
