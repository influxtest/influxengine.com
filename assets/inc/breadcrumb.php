<?php

$curpath =  explode("/", $_SERVER["REQUEST_URI"]);
array_splice($curpath, 0, 1);
array_splice($curpath, count($curpath) - 1, 1);
?>
<nav class="breadcrumb animate fadeIn">
  <ul>
    <li><a href="/">Home</a></li>
    <?php
      $len = count($curpath);
      for ($i = 0; $i < $len; $i++) {

        $pathname = "";
        if (!empty($breadcrumb)) {
          $pathname = $breadcrumb[$i];
        }
        else {
          $pathname = str_replace("-", " ", ucfirst($curpath[$i]));
        }

        $newpath = "";

        for ($j = 0; $j <= $i; $j++) {
          $newpath .= "/" . $curpath[$j];
        }
        echo "
        <li>
          <a href='$newpath/'>$pathname</a>
        </li>";
      }
    ?>

  </ul>
</nav>
