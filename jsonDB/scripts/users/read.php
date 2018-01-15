<?php 
    if(!empty($_POST['path'])) {
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];
        $string = file_get_contents($path);

        echo $string;
    }
?>