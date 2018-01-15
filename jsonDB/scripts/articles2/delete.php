<?php 
  if(!empty($_POST['data'])) {
        $fullId = str_replace("\"", "", $_POST['data']);
        $theme = substr($fullId, 0, 2);
        $id = intval(substr($fullId, 2, 6));
        
        
        
        
        // Defense to write in one time, wait while file will unlocked
        //http://php.net/manual/en/splfileobject.flock.php
        ////////////////////////////////////////
        //     SplFileObject::flock           //  
        ////////////////////////////////////////
        
        
        

        $curDir = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/";
        
        $themepath = $curDir . $theme;
         
        $file = new SplFileObject($themepath, "c+");

        // Retrieve lastId
        $file->seek($id);
        $string = $file->current();

        $csvArray = explode(',', $string);
        $lastId = intval($csvArray[1]);


        // Clean full line      
        $file->fseek($file->ftell() - strlen($string));
        for ($i = 0; $i < strlen($string) - 1; $i++) {
          $file->fwrite(" "); 
        }
        $file->fwrite(PHP_EOL); 

        // Remove id from lastIds file
        $lastIdsPath = $curDir . "lastIds";
        $file2 = new SplFileObject($lastIdsPath, "c");
        $file2->fseek($lastId * 10);
        $file2->fwrite("        "); // clean all line (id line size = 8)         
   }
?>