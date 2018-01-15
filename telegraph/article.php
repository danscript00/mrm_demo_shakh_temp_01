<?php
  if(!empty($_GET['url'])) {
      header('Content-type: text/html; charset=UTF-8');
      
      $dom = new DOMDocument;
      $dom->loadHTMLFile($_GET['url']);
        
      $css = $dom->getElementsByTagName('link');
      foreach ($css as $link) {
        if ($link->getAttribute('rel') == "stylesheet") {
          $link->setAttribute('href', 'http://telegra.ph' . $link->getAttribute('href'));
        }
      }
      
      $js = $dom->getElementsByTagName('script');
      foreach ($js as $script) {
        $script->setAttribute('src', 'http://telegra.ph' . $script->getAttribute('src'));
      }
      
      $iframes = $dom->getElementsByTagName('iframe');
      foreach ($iframes as $iframe) {
        $iframe->setAttribute('src', 'http://telegra.ph' . $iframe->getAttribute('src'));
      }
      
      $images = $dom->getElementsByTagName('img');
      foreach ($images as $image) {
        if (strpos($image->getAttribute('src'), 'http://telegra.ph') == false) {
          $image->setAttribute('src', 'http://telegra.ph' . $image->getAttribute('src'));
        }    
      }
      
      $html = $dom->saveHTML();
      echo $html;   
  }
?>