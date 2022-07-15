<div class="logos is-hidden-tablet" style="--logoHeight: 75px;">
  <img class="animate fadeIn" src="/" alt="" />
  <img class="animate fadeIn" src="/" alt="" />
  <img class="animate fadeIn" src="/" alt="" />
  <img class="animate fadeIn" src="/" alt="" />
  <img class="animate fadeIn" src="/" alt="" />
</div>
<!-- These logos should not have an animation, only animation should be on tablet and above. -->
<div class="logo-slider is-visible-tablet">
  <div class="logos animate fadeIn" style="--logoHeight: 75px;">
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
    <img src="/" alt="" />
  </div>
</div>

<?php 

$js .= <<<EOT

setLogosWidth();

window.addEventListener('resize', setLogosWidth);

function setLogosWidth() {
  
  var logos = document.querySelectorAll(".logo-slider .logos");
  for (var i = 0; i < logos.length; i++) {
    var images = logos[i].querySelectorAll("img");
    let logosWidth = 0;
    for (var j = 0; j < images.length; j++) {
      var imageWidth = images[j].getBoundingClientRect().width;
      logosWidth += imageWidth;
    }
    
    logos[i].style.setProperty("--logosWidth", ((logosWidth / 2) + 15) + "px");
  }
  
  var sliders = document.querySelectorAll(".logo-slider");
  for (i = 0; i < sliders.length; ++i) {
    sliders[i].classList.add("active");
  }
}

EOT;

?>
