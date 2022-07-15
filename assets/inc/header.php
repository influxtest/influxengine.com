<?php /* header file that sets up all the meta information as well as includes CSS and some tracking scripts that must be included in the header */ ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/functions.php"; ?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">
<!-- 
::::::::::::::::::::::::::::::                                                                          
::::::::::::::::::::::::::::::                                                                          
::::::::::::::::::::::::::::::    @@@@                      @@@@  @@@@                                  
::::::::::::     :::::::::::::    @@@@                    @@@@    @@@@                                  
::::::::::::   :::::::::::::::    @@@@  @@@@ #@@@@@@    @@@@@@@@  @@@@  @@@@       @@@@  @@@@@      @@@@
:::::::::::: ::: :::::::::::::    @@@@  @@@@@@@@@@@@@@    @@@@    @@@@  @@@@       @@@@    @@@@   @@@@  
::::::::::::::   :::::::::::::    @@@@  @@@@@#    @@@@@   @@@@    @@@@  @@@@       @@@@      @@@@@@@    
::::::::::::     :::::::::::::    @@@@  @@@@       @@@@   @@@@    @@@@  @@@@       @@@@        @@@@     
::::::::::::     :::::::::::::    @@@@  @@@@       @@@@   @@@@    @@@@  @@@@@    #@@@@@      @@@@@@@    
::::::::::::     :::::::::::::    @@@@  @@@@       @@@@   @@@@    @@@@   #@@@@@@@@@@@@@    @@@@   @@@@  
::::::::::::::::::::::::::::::    @@@@  @@@@       @@@@   @@@@    @@@@     @@@@@@# @@@@  @@@@       @@@@
::::::::::::::::::::::::::::::                                                                          
::::::::::::::::::::::::::::::                                                                          
-->
<head>
  <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $seotitle ?></title>
  <meta name="description" content="<?php echo $seodesc ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes, user-scalable=no">
  <meta name="city" content="<?php echo $city; ?>" />
  <meta name="country" content="<?php echo $country; ?>" />
  <meta name="state" content="<?php echo $state; ?>" />
  <meta name="zipcode" content="<?php echo $zip; ?>" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo $seotitle ?>" />
  <meta property="og:description" content="<?php echo $seodesc ?>" />
  <meta property="og:site_name" content="<?php echo $sitename ?>" />
  <meta property="og:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" />
  <meta property="og:image" content="/assets/img/og-feat.jpg" />
  <link rel="shortcut icon" type="image/png" href="/favicon.png" />
  <link rel="canonical" href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" />
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/assets/css.php" ?>
  <?php echo $gscript; ?>
  <?php echo $richsnippet; ?>
</head>
<body class="<?php if (isset($section)) { echo $section; } ?> <?php if (isset($_GET[" f "])) { echo " gallery " . $_GET["f "]; } ?>">
  <?php 
    if (!empty($hasmatrix) && $hasmatrix && (empty($has_img_matrix) && !$has_img_matrix)) {
      include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/nav-matrix.php" ;
    }
    else if (!empty($has_img_matrix) && $has_img_matrix) {
      include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/nav-img-matrix.php" ;
    }
    else {
      include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/nav.php";
    }
    
  ?>
