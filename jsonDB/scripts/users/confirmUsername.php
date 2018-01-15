<?php 
    if(!empty($_POST['data'])) {
        $username = str_replace("\"", "", $_POST['data']);
        $filename = dirname( dirname( dirname(__FILE__) ) ) . "/data/users/" . $username . ".json";
        
        if (file_exists($filename)) {
            echo "False";
        } else {
            echo "True";
        }
    }
?>