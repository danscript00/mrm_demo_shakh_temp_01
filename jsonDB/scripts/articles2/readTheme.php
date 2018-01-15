<?php 
  if(!empty($_POST['data'])) {
      $jsondata = json_decode($_POST['data'], true);
      $count = intval($jsondata['count']);
      $offset = intval($jsondata['offset']);
      $theme = $jsondata['themesId']; 

      $themepath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/" . $theme;  
      
      $file = new SplFileObject($themepath, 'a+');

      $file->seek(PHP_INT_MAX);
      $lineIndex = $file->key() - $offset;
      
      $foundCount = 0;
      //$result = "{";
          
      while ($foundCount != $count and $lineIndex > -1) {  
          $file->seek($lineIndex);
         
           echo sprintf("%'.02d", $theme) . sprintf("%'.06d", $lineIndex) . "," . trim($file->current()) . "#";
          //$result .= '"' . sprintf("%'.02d", $theme) . sprintf("%'.06d", $lineIndex) . '":"' . trim($file->current()) . '",';
          /*$string = trim($file->current());
          
          if(!empty($string)) {
            echo $string . "\n";
            $foundCount++;
          }*/
                  
          $lineIndex--;
      }   
      
      //$result = substr($result, 0, -1);
      //$result .= "}";
      
      //echo json_encode($result);
      
   }
?>