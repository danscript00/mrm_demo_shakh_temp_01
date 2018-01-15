<?php 
  if(!empty($_GET['data'])) {
      $fullId = sprintf("%'.08d", str_replace("\"", "", $_GET['data']));
      $theme = substr($fullId, 0, 2);
      $id = intval(substr($fullId, 2, 6));

      $themepath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/" . $theme;
      
      $file = new SplFileObject($themepath);
      $file->seek($id);

      $string = $file->current();
      $csvArray = explode(',', $string);
      echo $csvArray[0];
   }
?>