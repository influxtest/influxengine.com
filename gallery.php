<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/variables.php" ?>
<?php

include $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . "index.php";

if (isset($_GET["gp"]) && $_GET["gp"]) {
  $patient = $_GET["gp"];
  
}

if (isset($_GET["gc"]) && $_GET["gc"]) {
  $category = $_GET["gc"];
  include $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/category.php";
}

if (isset($_GET["gs"]) && $_GET["gs"]) {
  $subcategory = $_GET["gs"];
  include $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/subcategory.php";
}

if (isset($_GET["gp"]) && $_GET["gp"]) {
  $seotitle = $gallerytitle . " Before & After Patient " . $patient . " | " . $sitename . "";
}

if (isset($_GET["gp"]) && $_GET["gp"]) {
  $seodesc = "See before and after photos of " . $procedurename . " Patient " . $patient . ", procedure performed by " . $city . " " . $profession . ", " . $doctorname . ". To schedule a consultation, call " . $phone . " today.";
}

$numimages = 0;

if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/")) {
  header("Location: $reqUrl/gallery/");
}
else if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/")) {
  header("Location: $reqUrl/gallery/" . $category . "/");
}
else if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/" . $patient . "/")) {
  header("Location: $reqUrl/gallery/" . $category . "/" . $subcategory . "/");
}

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/header.php" ?>

<section class="masthead short bg-image bg-four-fifths animate zoomOutBg" style="
  <?php 
    if (!empty($mastheadImage)) {
      echo "--bgImage: url($mastheadImage);";
    }
    else {
      echo "--bgImage: url(/assets/img/masthead/default.jpg);";
    }
  ?>">
  <div class="container pt50 pb70">
    <div class="flexy is-centered">
      <div class="flexy-item text-center">
        <h1 class="title-md mb10 white animate fadeIn"><?php echo $gallerytitle; ?> Gallery <span class="intro white block animate fadeIn">Plastic Surgery in <?php echo $city; ?><?php if (isset($patient)) { ?> | Patient <?php echo $patient; ?> <?php }?></span>
        </h1>
      </div>
    </div>
  </div>
</section>

<section class="<?php if ($galleryAlt) {echo "galleryAlt";}?>">
  <div class="container">
    <div class="animate fadeIn">
      <a class="anchor" id="nav"></a>


      <?php if (isset($category) && (!isset($patient) && (!isset($subcategory)))) {
        /* CATEGORY PAGE */

        
        $folderpath = $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/";
        $folderurlpath = $galleryRoot . $category . "/";
        $listofgallerydirs = array_filter(glob($folderpath . "*"), 'is_dir');
        $catupperfirst = ucfirst($category);
        echo "<div class='pv100'>";
        echo "<h2 class='title-sm text-center highlight-color'>$catupperfirst</h2>";
        echo '<div class="animate fadeIn text-center">';
        echo '<ul class="no-bullet">';
        foreach ($listofgallerydirs as $dir) {
          $galfolder = basename($dir);
          include $folderpath . $galfolder . "/subcategory.php";
          echo "<li><a href='" . $folderurlpath . $galfolder . "/'>" . $gallerytitle . "</a></li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
      } ?>

      <?php

      /* INDIVIDUAL GALLERY */
      if (isset($patient)) { ?>
        <div class="procedure-before-afters">
          <p class="mt50 animate text-center fadeIn gallery-navigation">
            <a href="../"><img class="arrow-left" src="/assets/img/_defaults/arrow-left-black.svg" alt="arrow"> Back to Gallery</a>
            <?php if (!empty($procedureurl)) { ?>
              &nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="<?php echo $procedureurl; ?>">Go to Procedure <img class="arrow-right" src="/assets/img/_defaults/arrow-right-black.svg" alt="arrow"> </i></a>
            <?php } ?>
          </p>

          <div class="procedure-gallery-container mw900">

            <div class="procedure-gallery animate fadeIn">

              <?php
              $prevpatient = sprintf("%02d", $patient + 1);
              $nextpatient = sprintf("%02d", $patient - 1);
              echo "<div class='gallery-controls mb20'>";
              if (file_exists($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/" . $prevpatient . "/")) {

                echo "<a class='prev-patient button reversed'  style='margin-right: auto;' href='/gallery/{$category}/{$subcategory}/{$prevpatient}/#nav'>Prev&nbsp;<span class='is-hidden-tablet'>Patient</span></a>";
              }

              echo "<p class='text-center mb0 patient-label'>Patient {$patient}</p>";
              if (file_exists($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/" . $nextpatient . "/")) {

                echo "<a class='next-patient button reversed' style='margin-left: auto;' href='/gallery/{$category}/{$subcategory}/{$nextpatient}/#nav'>Next&nbsp;<span class='is-hidden-tablet'>Patient</span></a>";
              }
              echo "</div>";
              ?>
              <div class="swiper-container procedure-gallery__swiper-gallery">

                <div class="swiper-wrapper">

                  <?php

                  $galleryfolder = $category . "/" . $subcategory;
                  $folderpath = $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $galleryfolder . "/" . $patient . "/";

                  $folderurlpath = $galleryRoot . $galleryfolder . "/" . $patient . "/";

                  $patientimages = glob($folderpath . "*.{jpg}", GLOB_BRACE);

                  foreach ($patientimages as $index => $file) {

                    $imgurl = $folderurlpath .  basename($file);

                    echo '<div class="swiper-slide"><div class="procedure-gallery__image">
                  <img src="' . $imgurl . '" alt="' .  $gallerytitle .' Before & After Image">
                  </div>';
                    if ($index % 2 != 0) {
                      echo "<span class='abs bottom left white pl10 pb10'>After</span>";
                    } else {
                      echo "<span class='abs bottom left white pl10 pb10'>Before</span>";
                    }
                    $numimages = $index + 1;
                    echo '</div>';
                  }
                  ?>
                </div>

              </div>
              <div class="swiper-container-thumbs">
                <style>

                </style>
                <div class="swiper-wrapper">
                  <?php

                  $galleryfolder = $category . "/" . $subcategory;
                  $folderpath = $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $galleryfolder . "/" . $patient . "/";

                  $folderurlpath = $galleryRoot . $galleryfolder . "/" . $patient . "/";

                  $patientimages = glob($folderpath . "*.{jpg}", GLOB_BRACE);

                  foreach ($patientimages as $index => $file) {

                    $imgurl = $folderurlpath .  basename($file);

                    echo '<div class="swiper-slide"><div class="procedure-gallery__image">
              <img src="' . $imgurl . '" alt="' .  $gallerytitle .' Before & After Image">
              
              </div></div>';
                  }
                  ?>
                </div>
              </div>
              <!-- <div class="swiper-button-prev swiper-button-color"></div>
              <div class="swiper-button-next swiper-button-color"></div> -->
              <div class="swipe-icon animate fadeInUp is-hidden-desktop">
                <img src="/assets/img/_defaults/swipe-icon.png" alt="swipe">
                <span>Swipe To Next <i class="fa fa-chevron-right"></i></span>
              </div>

            </div>
          </div>

        </div>
    </div>
    <div class="animate fadeIn mb100">
      <?php
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $galleryfolder . "/" . $patient . "/patient.php")) {
          include $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $galleryfolder . "/" . $patient . "/patient.php";
        }

        if (!empty($patientInfo)) {
      ?>
        <div class="patient-details mw1000">
          <h4 class="text-center">Patient Details</h4>
          <?php
          echo "<p class='text-center'>" . $patientInfo . "</p>";
          if (!empty($patientData1)) {
            echo "<div class='flexy'><div class='flexy-item'>";

            echo $patientData1;
            echo "</div><div class='flexy-item'>";
            echo $patientData2;
            echo "</div>";
          }
          echo "</div>";
          ?>
        </div>
      <?php } ?>
      <?php
        $numbthumbs = $numimages / 2;
        if ($numbthumbs < 2) {
          echo "<style>.swiper-container-thumbs {display: none !important;}</style>";
        }
        $js .= "
      var thumbsSwiper = new Swiper('.swiper-container-thumbs', {
        slidesPerView: $numbthumbs,
        slideToClickedSlide: true,
        shortSwipes: false,
        threshold: 10,
        spaceBetween: 10,
        breakpoints: {
          480: {
            
            
            
          },

        },  
        

      });

      var gallerySwiper = new Swiper('.procedure-gallery__swiper-gallery', {
        navigation: {
          nextEl: '.procedure-gallery .swiper-button-next',
          prevEl: '.procedure-gallery .swiper-button-prev'
        },
        threshold: 10,
        speed: 500,
        slidesPerView: 2,
        slidesPerGroup: 2,
        spaceBetween: 10,
        breakpoints: {
          
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
          el: '.procedure-gallery-container__swiper-pagination',
          type: 'custom',
          renderCustom: function (swiper, current, total) {
            return current + ' / ' + total;
          }
        },
        thumbs: {
          swiper: thumbsSwiper
        }
        
        
        
        
      });
      setTimeout(function(){
        thumbsSwiper.update();
      }, 200);
      
      ";


      ?>
    <?php
      } else if (isset($subcategory)) {
        /* SUB CATEGORY PAGE */
        $gallerycount = 6;
        $folderpath = $_SERVER['DOCUMENT_ROOT'] . $galleryRoot . $category . "/" . $subcategory . "/";

        $folderurlpath = $galleryRoot . $category . "/" . $subcategory . "/";


        $listofgallerydirs = array_reverse(array_filter(glob($folderpath . "*"), 'is_dir'));

        ?>
          <p class="mt50 animate text-center fadeIn gallery-navigation">
            <a href="../"><img class="arrow-left" src="/assets/img/_defaults/arrow-left-black.svg" alt="arrow"> Back to Galleries</a>
            <?php if (!empty($procedureurl)) { ?>
              &nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="<?php echo $procedureurl; ?>">Go to Procedure <img class="arrow-right" src="/assets/img/_defaults/arrow-right-black.svg" alt="arrow"> </i></a>
            <?php } ?>
          </p>
        <?php
        


        echo '<div class="gallery-grid mb200">';
        foreach ($listofgallerydirs as $dir) {
          $patientnumber = basename($dir);

          $dir = $dir . "/";

          $patientimages = glob($dir . "*.{jpg}", GLOB_BRACE);
          echo '<div class="gallery-grid__row">';
          if ($galleryAlt) {
            $imgurl = $folderurlpath . $patientnumber . "/" .  "01.jpg";
            echo '<a href="' . $folderurlpath . $patientnumber  . '/#nav"><img src="' . $imgurl . '" alt="' .  $gallerytitle .' Before & After Image"></a>';

            echo '<a class="gallery-grid__details" href="' . $folderurlpath . $patientnumber  . '/"><span>Patient ' . $forwardCount . '</span></a>';
            $forwardCount ++;
          } else {
            foreach ($patientimages as $index => $file) {
              if ($index < $gallerycount) {
                $imgurl = $folderurlpath . $patientnumber . "/" .  basename($file);
  
                echo '<a href="' . $folderurlpath . $patientnumber  . '/#nav"><img src="' . $imgurl . '" alt="' .  $gallerytitle .' Before & After Image"></a>';
              }
            }
            echo '<a class="gallery-grid__details" href="' . $folderurlpath . $patientnumber  . '/"><span>View Patient Details</span></a>';
          }
          echo '</div>';
        }
        echo '</div>';
      } else { ?>



    <?php } ?>

    <?php
    if (!isset($category)) {
    ?>

      <div class="pv100">
        <div class="cascade-wrapper">
          <?php
          $dirs = array_filter(glob($_SERVER['DOCUMENT_ROOT'] . "$galleryRoot*"), 'is_dir');
          echo "<div class='cascade is-3 is-grid'>";
          foreach ($dirs as $dir) {
          ?>
              <div class="animate fadeIn text-center">
                <?php
                include $dir . "/category.php";
                echo "<h3 class='title-sm text-center highlight-color'>$gallerytitle</h3>";
                echo "<ul class='no-bullet'>";
                $subdirs = array_filter(glob($dir . "/*"), 'is_dir');
                foreach ($subdirs as $subdir) {

                  include $subdir . "/subcategory.php";

                  $galpath = substr($galleryRoot, 0, -1) . explode(substr($galleryRoot, 0, -1), $subdir)[1] . "/";

                  echo "<li><a href='$galpath'>$gallerytitle</a></li>";
                }
                ?>
                </ul>
              </div>
            
          <?php
          
          }
          ?>
        </div>
      <?php
    }
      ?>
      </div>


    </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/request-consult.php" ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/footer.php" ?>
