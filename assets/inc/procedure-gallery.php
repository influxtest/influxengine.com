<?php /* this looks through /gallery/ and its subfolders plus a provided argument to show a swipable gallery applicable to a precoedure */ ?>
<div class="container animate fadeIn">
  <div class="procedure-before-afters" id="gallery">
    

    <div class="inline-gallery animate fadeIn">
      <div class="swiper-container inline-gallery-container">
        <div class="inline-gallery-controls">
          <div class="black inline-gallery-pagination intro"></div>
          <div class="inline-gallery-prev"></div>
          <div class="inline-gallery-next"></div>
  
        </div>
        <h2 class="animate fadeIn title-sm mb20 text-center"><?php echo ucwords(str_replace("-", " ", explode("/", $galleryfolder)[2])); ?> Before & Afters</h2>
        <div class="swiper-wrapper">
          <?php
          $folderpath = $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $galleryfolder . "/";

          $folderurlpath = substr($galleryRoot, 0, -1) . $galleryfolder . "";


          
          $listofgallerydirs = array_reverse(array_filter(glob($folderpath . "*"), 'is_dir'));

          foreach ($listofgallerydirs as $dir) {
            $patientnumber = basename($dir);

            $dir = $dir . "/";
            $patientimages = glob($dir . "*.{jpg}", GLOB_BRACE);

            foreach ($patientimages as $index => $file) {

              if ($index < $gallerycount) {
                // <img class="swiper-lazy" alt="' . ucfirst(str_replace("-", " ", explode("/", $galleryfolder)[2])) . ' Before & After Image" data-src="/assets/inc/resize.php?img=' . $imgurl . '&amp;thumbratio=square">
                $imgurl = $folderurlpath . $patientnumber . "/" .  basename($file);
                echo '<div class="swiper-slide"><a href="' .  $folderurlpath . $patientnumber . '/#nav">
                  
                  <img class="swiper-lazy" alt="' . ucfirst(str_replace("-", " ", explode("/", $galleryfolder)[2])) . ' Before & After Image" data-src="' . $imgurl . '">
                  

                  </a>';
                if ($index % 2 != 0) {
                  echo "<span class='abs bottom left pl10 pb10 white'>After</span>";
                } else {
                  echo "<span class='abs bottom left pl10 pb10 white'>Before</span>";
                }
                echo '</div>';
              }
            }
          }
          ?>

        </div>
      </div>

      <div class="swipe-icon animate fadeInUp is-hidden-desktop">
        <img src="/assets/img/_defaults/swipe-icon.png" alt="swipe">
        <span>Swipe To Next <i class="fa fa-chevron-right"></i></span>
      </div>
    </div>
  </div>
</div>

<?php

$js .= "
var gallerySwiper = new Swiper('.inline-gallery-container', {
  navigation: {
    nextEl: '.inline-gallery-next',
    prevEl: '.inline-gallery-prev'
  },
  speed: 500,
  slidesPerView: 4,
  slidesPerGroup: 4,
  spaceBetween: 10,
  threshold: 10,
  breakpoints: {
    1500: {
      slidesPerView: 4,
      slidesPerGroup: 4
    },
    769: {
      slidesPerView: 2,
      slidesPerGroup: 2
    },
    480: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 10
    }
  },  
  fadeEffect: {
    crossFade: true
  },
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  on: {
    slideChange: function () {
      $('.swipe-icon').fadeOut();
    }
  },
  pagination: {
    el: '.inline-gallery-pagination',
    type: 'custom',
    renderCustom: function (swiper, current, total) {
      return current + '/' + total;
    }
  },
  
  preloadImages: false,
  
  lazy: {
    loadPrevNext: true,
    loadPrevNextAmount: 4
  }
});";

?>
