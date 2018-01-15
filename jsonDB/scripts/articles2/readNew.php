<?php 
  if(!empty($_POST['data'])) {
        $jsondata = json_decode($_POST['data'], true);
        $count = intval($jsondata['count']);
        $offset = intval($jsondata['offset']);
              
        $dir = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/";
        $lastIdsPath = $dir . "lastIds";
         
        $file = new SplFileObject($lastIdsPath, 'a+');

        $file->seek(PHP_INT_MAX);
        $lineIndex = $file->key() - $offset;

        $array = array();
        $foundCount = 0;
        
        while ($foundCount != $count and $lineIndex > -1) {  
          $file->seek($lineIndex);
         
          $string = trim($file->current());
          
          if(!empty($string)) {
            $array[] = $string;
            $foundCount++;
          }
                  
          $lineIndex--;
        }

        $result = "";

        asort($array); // Sort ids by themes

        $bufArray = array();
        $currentThemeId = 0;

        foreach ($array as &$value) {         
          $themeId = intval(substr($value, 0, 2));

          if ($themeId == $currentThemeId) {
            $bufArray[] = substr($value, 2);
          }
          else {
            if(count($bufArray) > 0) {
              $themepath = $dir . sprintf("%'.02d", $currentThemeId);        
              $themefile = new SplFileObject($themepath);      
              
              foreach ($bufArray as &$id) {  // Get links in current theme
                $themefile->seek(intval($id));

                $jsonArray = explode(',', trim($themefile->current()));

                $result .= '"' . $themeId . $id . '":"' . $jsonArray[0] . '",';
              }

              $bufArray = array();
            }

            $bufArray[] = substr($value, 2);
            $currentThemeId = $themeId;
          }
        }
     
        if(count($bufArray) > 0) { // Repeat for last theme
          $themepath = $dir . sprintf("%'.02d", $currentThemeId);        
          $themefile = new SplFileObject($themepath);      
          
          foreach ($bufArray as &$id) {  // Get links in current theme
            $themefile->seek(intval($id));

            $jsonArray = explode(',', trim($themefile->current()));

            $result .= '"' . $themeId . $id . '":"' . $jsonArray[0] . '",';
          }
        }

        echo "{" . substr($result, 0, -1) . "}";
   }
?>