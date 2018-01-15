<?php 
    if(!empty($_POST['data'])) {
    
        // FOR FIRST SEARCH BU SUM THEME ID
        // AFTER - SPLIT BY THEMES
    
    
    
    
        $id = str_replace("\"", "", $_POST['data']);
       
        $theme = substr($id, 0, 2);
        $id = substr($id, 2, 6);
        
        $secondFolder = substr($id, 0, 2); 
        $thirdFolder = substr($id, 2, 2);     
        $lastIdPart = substr($id, 4, 2);
        
        $jsonpath = dirname( dirname( dirname(__FILE__) ) ) . "/data/articles/" . $theme . "/" . $secondFolder . "/" . $thirdFolder . "/list.json";
        
        $string = file_get_contents($jsonpath);
        $string = "{" . substr($string, 0, -1) . "}";
             
        $oldjson = json_decode($string, true);
        
        echo $oldjson[$id];
    }
?>