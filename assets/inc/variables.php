<?php /* file meant to handle all of the client specific details, including phone number, email and address as well as tracking codes */ ?>
<?php

// VARIABLE INSTANTIATION

$js = "";
$noobfjs = "";

// SITE SPECIFIC VARIABLES
$hasmatrix = false;
$has_img_matrix = true;
$watermark = false;
$galleryRoot = "/gallery/";
$galleryAlt = false;
$sitename = "Plastic Surgery & Medspa";
$doctorname = "Dr. Name";
$profession = "plastic surgeon"; // this should be whatever the profession is i.e. plastic surgeon, cosmetic dermatologist, contractor, etc.
$sitedomain = "doctor.com"; // this should be just the second and top level domain nothing else (e.g. google.com)
$street = "123 Anystreet";
$city = "Any City";
$state = "CA";
$zip = "90028";
$country = "United States (usa)";
$address = "$street, $city, $state $zip";
$phone = '123.456.7890';
$fax = '';
$reviewcount = "4/5 Stars from 100+ Reviews";
$phonelink = <<<EOT
<a class="tel-link"  href="tel:$phone" onclick="gtag('event', 'click', {'event_category': 'phone' ,'event_label': 'call'});">$phone</a>
EOT;
$hours = 'Mon-Thu: 9am – 5pm<br/>
Friday: 9am – 2pm<br/>
Saturday: 9am – 3pm';
$leadsemail = 'replace@influxmarketing.com';
$bccemails = [
  "leads@influxmarketing.com",
];
$sendgridkey = "";

// Most common time zones, set below
// Eastern Time ...................... "America/New_York"
// Central Time ...................... "America/Chicago"
// Mountain Time ..................... "America/Denver"
// Mountain Time no DST .............. "America/Phoenix"
// Pacific Time ...................... "America/Los_Angeles"
// Alaska Time ....................... "America/Anchorage"
// Hawaiian-Aleutian Time ............ "America/Adak"
// Hawaiian-Aleutian Time no DST ..... "Pacific/Honolulu"

//full list of timezones here: https://www.php.net/manual/en/timezones.php

$_timezone = "America/Los_Angeles"; // set timezone here

try {
  $timezone = new DateTimeZone($_timezone);
}
catch (Exception $ex) {
  echo 'Set timezone in variables.php';
}

// FOR SEO
$richsnippet = '';
$rating = '<span class="ratings"><span class="ratings-stars"><img src="/assets/img/_defaults/star-black.svg" alt="star"><img src="/assets/img/_defaults/star-black.svg" alt="star"><img src="/assets/img/_defaults/star-black.svg" alt="star"><img src="/assets/img/_defaults/star-black.svg" alt="star"><img src="/assets/img/_defaults/star-black.svg" alt="star"></span><span class="ratings-text">5/5 Stars from 200+ Reviews</span></span>';
$trackingscript = '<script src="//scripts.iconnode.com/IDNUMBER.js"></script>';
$gscript = <<<GOOGLE
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-123456'></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag() {
  dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'UA-123456');
gtag('config', 'AW-123456');
</script>
GOOGLE;