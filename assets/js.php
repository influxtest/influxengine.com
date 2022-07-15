<script type="text/javascript">
  <?php
  $addjs = "";

  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/' . 'jquery-3.3.1.min.js');
  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/' . 'swiper.min.js');
  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/' . 'jquery.lazyloadxt.js');

  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/gsap/' . 'gsap.min.js');
  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/gsap/' . 'ScrollTrigger.min.js');
  $addjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/gsap/' . 'SplitText.min.js');

  echo $addjs;

  echo "var youdidntsaythemagicword = '';";

  $obfjs = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/' . 'scripts.js');
  $obfjs .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/js/' . 'custom.js');
  $obfjs .= $js;

  
  include $_SERVER['DOCUMENT_ROOT'] . '/assets/vendor/Packer.php';
  $packer = new Tholu\Packer\Packer($obfjs, 'Normal', true, false, false);
  $packed_js = $packer->pack();
  echo $packed_js;

  echo $noobfjs;

  ?>
</script>

<script src="//inflxio.s3-us-west-1.amazonaws.com/popup.js"></script>
<script src="//assets.inflx.io/scripts.js"></script>
<script src="https://assets.inflx.io/ada.js"></script>

<?php echo $trackingscript; ?>

<script>
/*lazy load javascript*/
let loadScripts = setInterval(function(){
  if ($(document).scrollTop()> 1) {


    clearInterval(loadScripts);
  }
}, 500);
</script>
