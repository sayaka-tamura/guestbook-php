<?php

  function severInfo(){
      $h = $_SERVER['HTTP_HOST'];
      $r = $_SERVER['HTTP_REFERER'];

      return array($h, $r);
  }
?>