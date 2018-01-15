<?php 
    $fi = new FilesystemIterator(__DIR__ . "/07", FilesystemIterator::SKIP_DOTS);
    echo iterator_count($fi);
    
    

    
    
    
?>