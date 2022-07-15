<?php
  echo "<style>";
  /* INCLUDE CSS FILES */
  $addcss = "";
  
  $addcss .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/css/' . 'normalize.css');
  $addcss .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/css/' . 'minireset.css');
  $addcss .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/css/' . 'swiper.min.css');  
  
  $minify = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$addcss)))));

  echo $minify;
  // echo $addcss;

  /* SASS COMPILER */
  /* forcing a file */

  $_GET["p"] = "styles.scss";
  require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/vendor/scssphp/scss.inc.php";
  require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/vendor/scssphp/example/Server.php";
  use Leafo\ScssPhp\Compiler;
  use Leafo\ScssPhp\Server;
  $scss = new Compiler();
  $scss->setImportPaths($_SERVER['DOCUMENT_ROOT'] . "/assets/css/");
  $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
  $server = new Server($_SERVER['DOCUMENT_ROOT'] . '/assets/css', null, $scss);
  $server->serve();
  echo "</style>";
?>
