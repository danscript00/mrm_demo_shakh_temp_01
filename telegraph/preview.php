<?php
  if(!empty($_GET['url'])) {
      $dom = new DOMDocument;
      
      $dom->loadHTMLFile($_GET['url']);
      
      $metas = $dom->getElementsByTagName('meta');
      
      $jsondata = array();
      
      foreach ($metas as $meta) {
        $property = $meta->getAttribute('property');
        
        if($property == "og:title") {
          $jsondata['title'] = $meta->getAttribute('content');
        }
        else if($property == "og:description") {
          $jsondata['description'] = $meta->getAttribute('content');
        }
        else if($property == "og:image") {
          $jsondata['img'] = $meta->getAttribute('content');
        } 
      }
      
      header('Content-type: application/json; charset=UTF-8');
      echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);    
  }
?>