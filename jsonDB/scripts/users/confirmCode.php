<?php 
    if(!empty($_POST['data']) and !empty($_POST['path'])) {
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];
        $string = file_get_contents($path);
        $oldjson = json_decode($string, true);

        $code = str_replace("\"", "", $_POST['data']);

        if($oldjson['code'] == $code) {
            $oldjson['isActive'] = 1;
            file_put_contents($path, json_encode($oldjson));

            echo "True";
        }
        else {
            echo "False";
        }
    }
?>