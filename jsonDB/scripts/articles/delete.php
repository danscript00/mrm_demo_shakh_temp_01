<?php 
    if(!empty($_POST['data'])) {
        $id = str_replace("\"", "", $_POST['data']);
       
        $theme = substr($id, 0, 2);
        $id = substr($id, 2, 6);
        
        $secondFolder = substr($id, 0, 2); 
        $thirdFolder = substr($id, 2, 2);     
        $lastIdPart = substr($id, 4, 2);    
        
        $jsonpath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles/" . $theme . "/" . $secondFolder . "/" . $thirdFolder . "/list.json";
        
        $string = trim(file_get_contents($jsonpath));
        $string = "{" . substr($string, 0, -1) . "}";
             
        $oldjson = json_decode($string, true);
           
        unset($oldjson[$id]);
         
        $srting = trim(json_encode($oldjson));         
        $srting = substr($string, 1, -1) . ",";  
        
        file_put_contents($jsonpath, $srting); // or die("Error")
        //shell_exec('echo 2>&1 > ' . $jsonpath . ' ' . escapeshellarg($srting));
         
        echo "OK";
        
    }
?>