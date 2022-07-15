<?php

// // FOR DEBUGGING
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// FOR LIVE
error_reporting(E_ERROR | E_PARSE);

include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/variables.php";

if (isset($_GET["influx_source"])) {
  $_SESSION["influx_source"] = str_replace("_", " ", $_GET["influx_source"]);
}

function ratingstars($rating_value, $rating_volume) {

  if ($rating_value > 5) $rating_value = 5;
  $half_stars = round($rating_value * 2);
  $star_markup = "";
  while ($half_stars > 0) {
    if ($half_stars > 1) {
      $star_markup .= '<img src="/assets/img/_defaults/icon-sharp-star.svg" alt="star">';
      $half_stars -= 2;
    } else {
      $star_markup .= '<img src="/assets/img/_defaults/icon-sharp-half-star.svg" alt="half-star">';
      $half_stars--;
    }
  }

  $rating_num = strval(round($rating_value, 1));
  if (strlen($rating_num) <= 1) $rating_num .= ".0";

  echo <<<STARRY
  <span class="ratingstars">
    <span class="ratings-number">{$rating_num}</span>
    <div>
      <span class="ratings-stars">
        {$star_markup}
      </span>
      <span class="ratings-text">from {$rating_volume}+ Reviews</span>
    </div>
  </span>
STARRY;

}

// SCHEDULING FUNCTIONS

// Returns true if the site is being hosted for QA
function site_in_review() {
  $on_localhost = strcmp(substr($_SERVER['HTTP_HOST'], 0, 9), "localhost") == 0;
  $on_dev = strcmp(substr($_SERVER['HTTP_HOST'], -12), "dev.inflx.io") == 0;
  $on_stage = strcmp(substr($_SERVER['HTTP_HOST'], -14), "stage.inflx.io") == 0;
  return $on_localhost OR $on_dev OR $on_stage;
}

// Examples for using the functions below
/* 
<?php if (its_after("2021-11-01 00:00") AND its_before("2021-11-30 23:59")): ?>
 <img src="/assets/img/specials/2021-november.jpg" alt="These will only be visible in November">
<?php endif; ?>

<?php if (expires_on("2021-11-30")): ?>
 <img src="/assets/img/specials/2021-november.jpg" alt="This will disappear after November">
<?php endif; ?>
*/
// These functions will always return true if the site is in review, so that the content can be QAed.

$_SESSION['datetime_label_count'] = 0;

// Returns true if the current time is after the one provided as an argument
function its_after(string $begin) {

  // Use this format for the date arguments:
  $datetime_format = "Y-m-d H:i";
  // e.g. "2021-4-20 23:59"

  if (gettype($begin) === 'string') {
    $begin_datetime = DateTime::createFromFormat($datetime_format, $begin, $GLOBALS['timezone']);
    if ($begin_datetime === false) {
      return false; // If the format is incorrect then always err on the side of caution
    }
  }

  $reviewing = site_in_review();
  $now_datetime = new DateTime('now', $GLOBALS['timezone']);
  $visible = $begin_datetime->getTimestamp() < $now_datetime->getTimestamp();
  $inner_html = $visible ? "The content below became visible on {$begin_datetime->format('F jS, Y h:i T')}" : "The content below will be visible after {$begin_datetime->format('F jS, Y h:i T')}";

  if ($reviewing) {
    echo "<a data-labeled='{$_SESSION['datetime_label_count']}' style='width: 0; height: 0; opacity: 0;'></a><span data-label='{$_SESSION['datetime_label_count']}' data-before='false' style='background: white; font-size: 16px; color: red; outline: 1px dashed red; padding: 5px; opacity: 0.75; position: absolute; z-index: 10000;'>$inner_html</span>";
    $_SESSION['datetime_label_count']++;
  }

  return $visible OR $reviewing;
}

// Returns true if the current time is before the one provided as an argument
function its_before(string $end) {

  // Use this format for the date arguments:
  $datetime_format = "Y-m-d H:i";
  // e.g. "2021-4-20 23:59"

  if (gettype($end) === 'string') {
    $end_datetime = DateTime::createFromFormat($datetime_format, $end, $GLOBALS['timezone']);
    if ($end_datetime === false) {
      return false; // If the format is incorrect then always err on the side of caution
    }
  }

  $reviewing = site_in_review();
  $now_datetime = new DateTime('now', $GLOBALS['timezone']);
  $visible = $now_datetime->getTimestamp() < $end_datetime->getTimestamp();
  $inner_html = $visible ? "The content below will be visible until {$end_datetime->format('F jS, Y h:i T')}" : "The content below disappeared after {$end_datetime->format('F jS, Y h:i T')}";

  if ($reviewing) {
    echo "<a data-labeled='{$_SESSION['datetime_label_count']}' style='width: 0; height: 0; opacity: 0;'></a><span data-label='{$_SESSION['datetime_label_count']}' data-before='true' style='background: white; font-size: 16px; color: red; outline: 1px dashed red; padding: 5px; opacity: 0.5; position: absolute; z-index: 10000;'>$inner_html</span>";
    $_SESSION['datetime_label_count']++;
  }

  return $visible OR $reviewing;
}

// Returns true if the current date is before the provided expiration date
function expires_on(string $end) {

  // Use this format for the date arguments:
  $datetime_format = "Y-m-d";
  // e.g. "2021-4-20 23:59"

  if (gettype($end) === 'string') {
    $end_datetime = DateTime::createFromFormat($datetime_format, $end, $GLOBALS['timezone']);
    if ($end_datetime === false) {
      return false; // If the format is incorrect then always err on the side of caution
    }
    $end_datetime->setTime(23, 59, 59);
  }

  $reviewing = site_in_review();
  $now_datetime = new DateTime('now', $GLOBALS['timezone']);
  $visible = $now_datetime->getTimestamp() < $end_datetime->getTimestamp();

  if ($reviewing) {
    echo "<a data-labeled='{$_SESSION['datetime_label_count']}' style='width: 0; height: 0; opacity: 0;'></a><span data-label='{$_SESSION['datetime_label_count']}' data-before='true' style='background: white; font-size: 16px; color: red; outline: 1px dashed red; padding: 5px; opacity: 0.5; position: absolute; z-index: 10000;'>The content below will disappear at the stroke of midnight on {$end_datetime->format('F jS, Y')}</span>";
    $_SESSION['datetime_label_count']++;
  }
  
  return $visible OR $reviewing;
}

if (site_in_review()) {
  $js .= "
  var labeledElements = Array.from(document.querySelectorAll('a[data-labeled]'));
  var labels = [];
  labeledElements.forEach(labeled => {
    let labelId = labeled.getAttribute('data-labeled');
    let label = document.querySelector('span[data-label=\'' + labelId + '\']');
    label.labelTarget = labeled;
    labels.push(label);
  });
  function repositionLabels (ev) {
    labels.forEach(label => {
      label.style.left = label.labelTarget.offsetLeft;
      let reposition = label.getAttribute('data-before') === 'true' ? 21 : -21;
      label.style.top = label.labelTarget.offsetTop + reposition + 'px';
    })
  }
  window.addEventListener('resize', repositionLabels);
  repositionLabels();
  ";
}

// END SCHEDULING FUNCTIONS