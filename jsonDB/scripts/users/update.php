<?php 
    if(!empty($_POST['data']) and !empty($_POST['path'])) {
        $path = dirname( dirname( dirname(__FILE__) ) ) . "/" . $_POST['path'];
        $string = file_get_contents($path);

        $oldjson = json_decode($string, true);
        $newjson = json_decode($_POST['data'], true);

        foreach ($newjson as $key => $value) {
            if ($key == "code" and $value == "") {
                unset($oldjson[$key]);
            }
            else if ($key == "password") {
              $oldjson[$key] = password_hash($value, PASSWORD_DEFAULT);
            }
            else {
                $oldjson[$key] = $value;
            }    
        }

        file_put_contents($path, json_encode($oldjson));
          
        echo "OK";
    }
?>