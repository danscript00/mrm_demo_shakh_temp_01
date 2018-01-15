<?php 
    if(!empty($_POST['data']) and !empty($_POST['path'])) {
        
        $password = str_replace("\"", "", $_POST['data']);
        
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];     
        $string = file_get_contents($path);
        $jsondata = json_decode($string, true);
        
        if (password_verify($password, $jsondata['password'])) {
          echo $jsondata['avatar_id'];
        }
        else {
          echo "False";
        }
                      
  }
?>

