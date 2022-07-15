"use strict";

const tabletWidth = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--tabletWidth'));
const desktopWidth = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--desktopWidth'));
const fullHdWidth = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--fullHd'));

$.fn.extend({
  animateCss: function (animationName, callback) {
    var animationEnd = (function (el) {
      var animations = {
        animation: 'animationend',
        OAnimation: 'oAnimationEnd',
        MozAnimation: 'mozAnimationEnd',
        WebkitAnimation: 'webkitAnimationEnd',
      };

      for (var t in animations) {
        if (el.style[t] !== undefined) {
          return animations[t];
        }
      }
    })(document.createElement('div'));

    this.addClass('animated ' + animationName).one(animationEnd, function () {
      $(this).removeClass('animated ' + animationName);

      if (typeof callback === 'function') callback();
    });

    return this;
  },
});

$('.accordion__question').click(function () {

  $(this).parent().toggleClass('open');
  if ($(this).parent().children(".accordion__answer").css("max-height") != "0px") {
    $(this).parent().children(".accordion__answer").css("max-height", "0px");
  } else {
    $(this).parent().children(".accordion__answer").css("max-height", $(this).parent().children(".accordion__answer")[0].scrollHeight + "px");
  }
});

function buildJumpBar() {
  var htmloutput = '<div class="in-page-jump__container"><a href="#" class="in-page-jump__menu">On this page  <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 1.5L17 5.5M17 5.5L12.5 9.5M17 5.5H1" stroke="#000000" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>';
  $("[data-ipj]").each(function () {
    htmloutput += '<a href="#';
    htmloutput += $(this).attr("id");
    htmloutput += '" class = "in-page-jump__item">';
    htmloutput += $(this).attr("data-ipj");
    htmloutput += ' <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 1.5L17 5.5M17 5.5L12.5 9.5M17 5.5H1" stroke="#000000" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>';
  });
  htmloutput += '</div>';
  $(".in-page-jump").append(htmloutput);
  $(".in-page-jump__item").click(function (e) {
    var headerOffset = $(".navbar").outerHeight() + $(".in-page-jump").height() + 50;
    e.preventDefault();
    window.history.pushState("state",$(this).attr("data-ipj"),$(this).attr("href"));
    $(".in-page-jump__container").removeClass("open");
    var jumpitem = $($(this).attr("href"));
    $('html, body').animate({
      scrollTop: $(jumpitem).offset().top - headerOffset + 1
    }, 500);

  });
  $(".in-page-jump__menu").click(function (e) {
    e.preventDefault();
    $(".in-page-jump__container").toggleClass("open");

  });
}

function jumpBar() {
  var headerOffset = $(".navbar").outerHeight();
  if ($(".in-page-jump").length) {
    if ($(window).scrollTop() > $(".in-page-jump").offset().top - headerOffset) {
      $(".in-page-jump__container").addClass("scrolled");
      $(".in-page-jump").addClass("animated");
      if ($(".in-page-jump__container").css("top") != undefined) {
        $(".in-page-jump__container").css("top", headerOffset + "px");
      }

    } else {
      $(".in-page-jump__container").removeClass('scrolled');
    }
    var jumplist = [];
    $(".in-page-jump__item").each(function () {

      var jumpitem = $($(this).attr("href"));

      if ($(window).scrollTop() > $(jumpitem).offset().top - headerOffset - 100) {
        jumplist.push($(this));
      }
    });

    if (!$(jumplist[jumplist.length - 1]).hasClass("scrolled")) {
      $(".in-page-jump__item").removeClass("scrolled");
      $(jumplist[jumplist.length - 1]).addClass("scrolled");
    }
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
      $(".in-page-jump__item").each(function () {
        $(this).removeClass("scrolled");
      });
      $(".in-page-jump__item").last().addClass("scrolled");
    }
  }
}

var inflx = {};

$(document).ready(function () {
  navbarBg();
  animate();
  getContainerOffset();
  
  subSelectorHeight();
  
  quicklinks();
  if ($(".in-page-jump").length) {
    jumpBar();
    buildJumpBar();
  }

  //Target mega menu just once
  inflx.megaMenu = $('.mega-menu').eq(0);
  //Use in place of $() to limit scope in mega menu
  inflx.inMegaMenu = sel => { return inflx.megaMenu.find(sel) }; 
  if (inflx.megaMenu.length) setupMatrix();
});

window.onscroll = function () {
  navbarBg();
  animate();
  lazyLoadSrc();
  if ($(".in-page-jump")) {
    jumpBar();
  }
};

document.querySelectorAll(".youtube-container").forEach(yt => {
  const iframe = yt.querySelector("iframe");
  const yturl = new URL(iframe.getAttribute("yt-src"));
  const ytID = yturl.pathname.replace("/embed/","");
  const ytImageUrl = "https://i3.ytimg.com/vi/" + ytID + "/maxresdefault.jpg";
  const newImage = document.createElement("img");
  newImage.setAttribute("data-src",ytImageUrl);
  yt.appendChild(newImage);
  yt.addEventListener("click", (el) => {
    yt.classList.add("loaded");
    yturl.searchParams.append("autoplay","1");
    iframe.setAttribute("src", yturl.href);
  });
});

function lazyLoadSrc() {
  document.querySelectorAll("[data-src]").forEach(element => {
    element.setAttribute("src", element.getAttribute("data-src"));
    element.removeAttribute("data-src");
  });
}

function quicklinks() {
  if ($(".quick-links").length) {
    var quicklink = $(".quick-links").find(".quick-link");
    $(".quick-links").siblings().find("a").each(function () {
      $(".quick-links").append($(quicklink).clone().append(`<a href="${$(this).attr("href")}">${$(this).children().first().text()}</a>`));
    });
    $(quicklink).remove();
  }
}



if ($(".is-swipable-touch").length) {
  $('.is-swipable-touch').scroll(function () {
    animate();
  });
}





function navbarBg() {
  if ($(document).scrollTop() > 90) {

    $("body").addClass("scrolled");

  } else {
    if ($("body").hasClass("scrolled")) {
      $("body").removeClass("scrolled");
    }
  }
}

/* START MENU BUTTON CODE */
$(document).keyup(function (e) {
  if (e.key === 'Escape') toggleHtmlOpen();
});

$(".menu-button").click(toggleHtmlOpen);

$('.overlay').click(toggleHtmlOpen);


/* END MENU BUTTON CODE */

/* START ALL FORM CODE */
// https://tc39.github.io/ecma262/#sec-array.prototype.find
if (!Array.prototype.find) {
  Object.defineProperty(Array.prototype, 'find', {
    value: function (predicate) {
      // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If IsCallable(predicate) is false, throw a TypeError exception.
      if (typeof predicate !== 'function') {
        throw new TypeError('predicate must be a function');
      }

      // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kValue be ? Get(O, Pk).
        // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. If testResult is true, return kValue.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return kValue;
        }
        // e. Increase k by 1.
        k++;
      }

      // 7. Return undefined.
      return undefined;
    },
    configurable: true,
    writable: true
  });
}

//Get all the inputs...
var inputs = document.querySelectorAll('input, select, textarea');

// Loop through them...
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop = function _loop() {
    var input = _step.value;

    // Just before submit, the invalid event will fire, let's apply our class there.
    input.addEventListener('invalid', function (event) {
      input.classList.add('error');
    }, false);

    // Optional: Check validity onblur
    input.addEventListener('change', function (event) {
      if (input.checkValidity()) {
        input.classList.remove('error');
      }
    });
  };

  for (var _iterator = inputs[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
    _loop();
  }
} catch (err) {
  _didIteratorError = true;
  _iteratorError = err;
} finally {
  try {
    if (!_iteratorNormalCompletion && _iterator.return) {
      _iterator.return();
    }
  } finally {
    if (_didIteratorError) {
      throw _iteratorError;
    }
  }
}

var fileInputs = document.querySelectorAll('input[type=file]');
Array.prototype.forEach.call(fileInputs, function (input) {
  var label = input.nextElementSibling,
    labelVal = label.innerHTML;

  input.addEventListener('change', function (e) {
    var fileName = '';
    if (this.files && this.files.length > 1) {
      fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
    }
    else {
      fileName = e.target.value.split("\\").pop();
    }
    if (fileName) {
      label.querySelector('span').innerHTML = fileName;
    }

    else {
      label.innerHTML = labelVal;
    }
  });
});



$('form').submit(function (event) {

  if ($(this).hasClass("no-ajax")) {
    return;
  }
  event.preventDefault();

  if ($(this)[0].checkValidity()) {
    var theform = $(this);


    $(theform).find('*').fadeOut();
    $(theform).append('<img class=\'loading animated fadeInUp\' src=\'/assets/img/_defaults/loading.gif\' alt=\'loading\' />');
    var formdata = new FormData();
    $(theform).find("input").prop("disabled", true);

    // data.append( 'file_attach', $('input[name=file_attach]')[0].files[0]);

    $(theform).find('input[type!="file"],textarea,select').each(function () {
      if ($(this).val() != "") {
        if ($(this).attr("type") == "checkbox") {
          if ($(this).is(":checked")) {
            formdata.append($(this).attr("name"), $(this).val());
          }
        } else {
          formdata.append($(this).attr("name"), $(this).val());
        }

      }
    });
    var filei = "1";
    $(theform).find('input[type="file"]').each(function () {
      if ($(this)[0].files[0]) {
        formdata.append('file' + filei, $(this)[0].files[0]);
        filei++;
      }
    });
    $.ajax({
      type: 'POST',
      url: $(theform).attr("action"),
      data: formdata,
      context: document.body,
      processData: false,
      contentType: false,
      success: function (response) {

        $(".loading").remove();

        $(theform).append("<div class='thankyou'><h3 class='title-sm text-center'>Thank you for your request</h3><p class='lead text-center'>We will get back to you as soon as possible.</p></div>");

        $("html, body").animate({
          scrollTop: $(theform).offset().top - 80
        });

        gtag('event', 'Submit', {
          'event_category': 'Form',
          'event_label': 'Consult'
        });

        try {
          fbq('track', 'Lead');
          fbq('trackCustom', 'WebForm');
        }
        catch (err) {
          //no FB code
        }
        

        const redirect = $(theform).attr("redirect");
        if (redirect) {
          window.location = $(theform).attr("redirect");
        }
        else {
          window.history.pushState("state", "Thank You", "?t=thank-you");
        }
      },
      error: function (request, status, error) {
        $(".loading").remove();
        $(".error-message").remove();
        var errormessage = "<p class='error-message'>" + error + "</p>";
        $(theform).append(errormessage);
      }
    });
  }
});

/* END ALL FORM CODE */


$(".modal-close").click(function () {
  $(".modal").removeClass("open");
  $(".modal-content").html('');
});

$(".modal-background").click(function () {
  $(".modal").removeClass("open");
  $(".modal-content").html('');
});

$(document).on('keyup', function (e) {
  if (e.key === "Escape") {
    $(".modal").removeClass("open");
    $(".modal-content").html('');
  }
});

$('a[href^="#"]').on('click', function (event) {

  var target = $(this.getAttribute('href'));

  if (target.length) {
    event.preventDefault();
    $('html, body').stop().animate({
      scrollTop: target.offset().top - 100
    }, 500);
  }

});

$("a[href='" + window.location.pathname + "']").addClass("active");


$(".youtube-video").click(function (e) {
  e.preventDefault();
  const yID = $(this).attr("href").split("?v=")[1];
  $(".modal-content").append("<div class='video-container'><iframe src='https://www.youtube.com/embed/" + yID + "?autoplay=1' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div>");
  $(".modal").addClass("open");
});


$(".vimeo-video").click(function (e) {
  e.preventDefault();
  const yID = $(this).attr("href").split("/video/")[1];
  $(".modal-content").append("<div class='video-container'><iframe src='https://player.vimeo.com/video/" + yID + " allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div>");
  $(".modal").addClass("open");
});

var isInViewport = function (elem) {
  const rect = elem.getBoundingClientRect();
  // DOMRect { x: 8, y: 8, width: 100, height: 100, top: 8, right: 108, bottom: 108, left: 8 }
  const windowHeight = (window.innerHeight || document.documentElement.clientHeight);
  const windowWidth = (window.innerWidth || document.documentElement.clientWidth);

  // http://stackoverflow.com/questions/325933/determine-whether-two-date-ranges-overlap
  const vertInView = (rect.top <= windowHeight) && ((rect.top + rect.height) >= 0);
  const horInView = (rect.left <= windowWidth) && ((rect.left + rect.width) >= 0);

  return (vertInView && horInView);
};

function animate() {
  let animateItems = document.querySelectorAll(".animate");
  animateItems.forEach(function (item) {
    if (isInViewport(item)) {
      item.classList.add("animated");
    }
  });
};


function getContainerOffset() {
  var container = document.querySelector(".container");
  var containerRect = container.getBoundingClientRect();
  let windowwidth = document.body.clientWidth;
  var containerOffset = (windowwidth - containerRect.width) / 2;

  if (windowwidth < tabletWidth) {
    const margin = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--marginTouch'));
    document.documentElement.style.setProperty('--containerOffset', margin + "px");
  }
  else if (windowwidth < fullHdWidth) {
    const margin = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--marginDesktop'));
    document.documentElement.style.setProperty('--containerOffset', margin + "px");
  }
  else {
    document.querySelector(":root").style.setProperty('--containerOffset', containerOffset + "px");
  }
}


$(".bg-rotate").each(function(){

  const images = $(this).attr("data-bgs").split(",");
  if (images.length > 0) {
    var nextImage = 0;
    var container = $(this)[0];
    var preloadImage = new Image();
    var bgspeed = $(this).attr("data-bg-speed");
    preloadImage.src = images[nextImage];
    

    var rotate = setInterval(function(){
      
      container.insertBefore(preloadImage,container.firstChild);        
      preloadImage.setAttribute("class","bg-rotate-image animate fadeIn");
      preloadImage.style.objectPosition = container.style.backgroundPosition;
      animate();
      setTimeout(function(){
        container.style.setProperty("--bgImage",`url(${images[nextImage]})`);
      },bgspeed / 2);
      nextImage++;
      if (nextImage == images.length) {
        nextImage = 0;
      }
      preloadImage.src = images[nextImage];
    
    },bgspeed);
  }

});


//START SELECTOR CODE

// widescreen variable we want the selector to break at
const widescreenWidth = 1280;

if ($(".selector").length) {
  $(".selector").click(function () {
  
    if (window.innerWidth < widescreenWidth) {
  
      if ($(this).closest(".selectors").hasClass("open")) {
        $(this).closest(".selectors").removeClass("open");
        $(this).siblings().each(function () {
          $(this).css("max-height", "0px");
        });
        const sel = $(this).index();
  
        //HANDLE SELECTORS
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
  
        //HANDLE SELECTOR ITEMS
  
        $(this).closest(".selector-container").find(".selector-items").first().children(".selector-item").removeClass("active").eq(sel).addClass("active");
  
      }
      else {
        $(this).closest(".selectors").addClass("open");
  
        $(this).siblings().each(function () {
  
          $(this).css("max-height", $(this)[0].scrollHeight + "px");
        })
      }
    }
    else {
      //get index of clicked itemf
      const sel = $(this).index();
  
      //HANDLE SELECTORS
      $(this).siblings().removeClass("active");
      $(this).addClass("active");
  
      //HANDLE SELECTOR ITEMS
  
      $(this).closest(".selector-container").find(".selector-items").first().children(".selector-item").removeClass("active").eq(sel).addClass("active");
    }
  });
  if (window.innerWidth < tabletWidth) {
    $(".selector").each(function(){
      if (!$(this).hasClass("active")) {
        $(this).css("max-height", "0px");
      }
    });
  }
}

function subSelectorHeight() {
  if ($(".sub-selector-items").length) {
    if (window.innerWidth < widescreenWidth) {
      $(".sub-selector-items").css("min-height", 0);
    }
    else {
      $(".selector-items").each(function () {
        $(".sub-selector-items").css("min-height", 0);
        let minheight = 0;
        $(this).find(".sub-selector-item").each(function () {
          const scrollheight = $(this)[0].scrollHeight;
  
          if (scrollheight > minheight) {
            minheight = scrollheight;
          }
        });
        $(this).find(".sub-selector-items").css("min-height", minheight);
      });
    }
  }
  

}

subSelectorHeight();


$(".sub-selector").click(function () {

  

  if (window.innerWidth < widescreenWidth) {

    const sel = $(this).index();

    //HANDLE SELECTORS
    $(this).siblings().removeClass("active");
    $(this).addClass("active");

    //HANDLE SELECTOR ITEMS

    $(this).closest(".sub-selector-container").find(".sub-selector-items").first().children(".sub-selector-item").removeClass("active").eq(sel).addClass("active");

  }
  else {
    //get index of clicked itemf
    const sel = $(this).index();

    //HANDLE SELECTORS
    $(this).siblings().removeClass("active");
    $(this).addClass("active");

    //HANDLE SELECTOR ITEMS

    $(this).closest(".sub-selector-container").find(".sub-selector-items").first().children(".sub-selector-item").removeClass("active").eq(sel).addClass("active");

  }
});


//END SELECTOR CODE


//START MENU CODE

function setupMatrix() {

  if (window.innerWidth <= desktopWidth) {
    mobileMatrixState();
  }
  else {
    desktopMatrixState();
  }

  inflx.inMegaMenu(".menu-selectors a").click(function () {

    if ($(this).hasClass("no-menu")) return;

    let $li = $(this).parent("li");

    inflx.inMegaMenu(".top-menu-menu li").removeClass("active");
    inflx.inMegaMenu(".main-menu.active li.active").removeClass("active");
    inflx.inMegaMenu(".main-menu.active").removeClass("active");

    if ($li.parent("ul").hasClass('menu-back')) {
      inflx.inMegaMenu(".menu-selectors").addClass("active");
    }
    else {

      inflx.inMegaMenu(".menu-selectors").removeClass("active");
      $li.addClass("active");
      inflx.inMegaMenu(".main-menu").eq($li.index()).addClass("active");
      matrixHeight();
    }
  });

  inflx.inMegaMenu(".main-menu ul li:first-child a").click(function (e) {

    if ($(this).hasClass("no-menu")) return;

    let $li = $(this).parent("li");

    if (window.innerWidth <= desktopWidth) {
      e.preventDefault();

      if ($li.hasClass("active")) {
        $li.removeClass("active");
      }
      else {
        inflx.inMegaMenu(".main-menu ul li:first-child").removeClass("active");
        $li.addClass("active");
      }
    }
  });
}

function mobileMatrixState() {

  inflx.inMegaMenu(".main-menu").removeClass("active");
  inflx.inMegaMenu(".menu-selectors li").removeClass("active");
  inflx.inMegaMenu(".menu-selectors").addClass("active");
  inflx.megaMenu.data("mobile", true);
}

function desktopMatrixState() {

  inflx.inMegaMenu(".main-menu.active li.active").removeClass("active");
  inflx.inMegaMenu(".main-menu.active").removeClass("active");
  inflx.inMegaMenu(".main-menu:first-child").addClass("active");
  inflx.inMegaMenu(".menu-selectors li.active").removeClass("active");
  inflx.inMegaMenu(".menu-selectors li:first-child").addClass("active");
  inflx.megaMenu.data("mobile", false);
}

const matrixNavbarHeight = $(".navbar").outerHeight();

function matrixHeight() {

  let headerHeight;

  if (window.outerWidth <= desktopWidth) {
    if (!inflx.megaMenu.data("mobile")) mobileMatrixState();
  }
  else {
    if (inflx.megaMenu.data("mobile")) desktopMatrixState();
    if ($("html").hasClass("open")) headerHeight = matrixNavbarHeight + inflx.megaMenu.outerHeight() + 'px';
  }

  $(".header").css("height", headerHeight || "auto");
}

function toggleHtmlOpen() {
  if ($('html').hasClass('open')) {
    let top = parseInt($('html').css('top'));
    $('html').removeClass('open').scrollTop(-1 * top);
  } else {
    let top = $('html').scrollTop();
    $('html').css('top', -1 * top).addClass('open');
  }
  $('html').trigger('classChange');
}

//$("html").on("classChange", matrixHeight);
$("html").on("classChange", () => {
  matrixHeight();
});

//END MENU CODE

window.onresize = function () {
  getContainerOffset();
  
  subSelectorHeight();
  
  if ($(".has-mega-matrix").length) {
    matrixHeight();
  }
  if ($(".in-page-jump").length) {
    jumpBar();
  }
};

$(".link-reveal-container").hover(function(){
  var container = $(this);
  setTimeout(function(){$(container).addClass("active");}, 1000);
  
},function(){
  $(this).removeClass("active");
});

//for local gallery development
(function (){
  if (location.hostname == "localhost") {
    //put root gallery URL here
    const galleryRoot = "gallery";
    //get all anchor tags
    document.querySelectorAll("a").forEach(anchor => {
      //check to see if gallery link
      const href = anchor.getAttribute("href");    
      if (href != null && href.includes(galleryRoot)) {
        //break up href
        const parts = href.split("/");
        //reconstruct local href
        let newlink = "/gallery.php?";
        for (let i = 2; i < parts.length; i++) {
          if (parts[i] != "") {
            if (i == 2) {
              newlink += "gc=";
            }
            else if (i == 3) {
              newlink += "&gs=";
            }
            else if (i == 4) {
              newlink += "&gp=";
            }
            newlink += parts[i];
          }
        }
        anchor.setAttribute("href", newlink);
      }
    });
  }
})();
