<?php 
    if(!empty($_POST['data'])) {
        $newjson = json_decode($_POST['data'], true);
        $theme = $newjson['themesId'];
           
        $themepath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles/" . $theme . "/";
        //$listIdPath = $themepath . 'listId';  
        
        //$_ENV['ARTICLES_00_ID'] = '000000';
        //echo $_ENV['ARTICLES_00_ID'] . "$\n"; 
        
        //echo shell_exec('getArticlesId ' . $theme);
        //echo `echo $(getArticlesId {$theme})`;
        //echo `echo \$\(getArticlesId 07\)`;
        //echo "END";
        
        //echo system('ls '.escapeshellcmd($themepath));
        
        //echo shell_exec('whoami');
        
        //$cmd = 'getArticlesId 2>&1 ' . $theme;
        //$result = shell_exec(escapeshellcmd($cmd));
        

        //echo exec ("sudo head -n 1 2>&1 " . escapeshellarg($listIdPath));
        //echo exec ("sed -i 2>&1 " . escapeshellarg($listIdPath));  
        //echo "sasa";
        
        //
        //$listIdPath = $themepath . 'listId';   
        //$currentId = shell_exec('head -n 1 ' . $listIdPath);
        //exec('head -n 1 ' . $listIdPath, $currentId);
        //echo $listIdPath . "\n";
        //$currentId = shell_exec('head -n 1 ' . $listIdPath . '; sed -i \'1d\' ' . $listIdPath);   
        //echo $currentId . "\n";
        



        // Store 63 array's of ids<?php
        //apc_store('ids', new ArrayObject($array));
        //$tmp = apc_fetch('ids'); 
        //print_r($tmp->getArrayCopy());
        //echo apcu_fetch('foo');
        //apcu_add('foo', "000001");
        
        
        
        
        
        
        /*$file = new SplFileObject($listIdPath, "w");
        $file->fseek(2);
        $file->fwrite("12345");
        echo $file->current();
        echo "La";*/
        
        

        
        
        //$tempvar=fopen($listIdPath,"r");
        //$currentId=fgets($tempvar);
        //echo $currentId;
        //fclose($tempvar);
        
          
          
        $currentId = file_get_contents($themepath . "id");    
        //file_put_contents($themepath . "id", sprintf("%'.06d\n", $currentId + 1));     
        shell_exec('echo > ' . $themepath . 'id ' . sprintf("%'.06d\n", $currentId + 1));
        echo  $currentId . "\n";
                
        $id = "";
        
        $secondFolder = substr($currentId, 0, 2);
        $id .= $secondFolder;
        
        $thirdFolder = substr($currentId, 2, 2);
        $id .= $thirdFolder;
        
        $lastIdPart = substr($currentId, 4, 2);
        $id .= $lastIdPart;
        
        $jsonpath = $themepath . $secondFolder . "/" . $thirdFolder . "/list.json";
        
        //$string = file_get_contents($jsonpath);
        //$oldjson = json_decode($string, true);
        //$oldjson[$lastIdPart] = $newjson['link'];  
        //file_put_contents($jsonpath, json_encode($oldjson));
        shell_exec('echo >> ' . $jsonpath . ' \"' . $id . '\":\"' . $newjson['link'] . '\",');
          
        echo "OK";
    }
?>