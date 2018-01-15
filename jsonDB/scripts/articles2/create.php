<?php 
  if(!empty($_POST['data'])) {
        date_default_timezone_set('UTC');

        $idjson = json_decode($_POST['data'], true);
        
        $theme = $idjson['themesId'];
        $link = $idjson['link'];
         
        $themepath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/" . $theme;
         



        // Defense to write in one time, wait while file will unlocked
        //http://php.net/manual/en/splfileobject.flock.php
        ////////////////////////////////////////
        //     SplFileObject::flock           //  
        ////////////////////////////////////////






        $file = new SplFileObject($themepath, "a+");      
 
        $file->seek(PHP_INT_MAX);
        $id = $theme . sprintf("%'.06d", $file->key()); // +1
        echo $id;
        

        // Save id to lastIds file for fast search by time (get new articles)
        $lastIdsPath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles2/lastIds";
        $file2 = new SplFileObject($lastIdsPath, "a+"); 
        
        $file2->seek(PHP_INT_MAX);
        $lastId = $file2->key();
             
        $file2->fwrite($id . PHP_EOL);

        
        // Save current article with help data (id from lastIds for removing later)
        $file->fwrite($link . "," . $lastId . PHP_EOL);
           




        // SHELL VERSION
        /*$cmd = "echo " . $link . " >> " . $themepath;
        $result = shell_exec(escapeshellcmd($cmd));  
        $id = shell_exec("wc -l 2>&1 < " . $themepath);
        echo $theme . sprintf("%'.06d\n", $id)*/
   }
?>