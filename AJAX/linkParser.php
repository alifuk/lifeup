<?php

if (isset($_POST['link']) && $_POST['link'] != "" && isset($_POST['owner']) && $_POST['owner'] != "") {

    
    include('../simplehtmldom_1_5/simple_html_dom.php');
    
    $html = file_get_html($_POST['link']);
    $title = "";
    $image = "";
    foreach($html->find('title') as $e){
        $title =  $e->innertext;        
    }
    
    foreach($html->find('meta[property="og:image"]') as $e){
        $image =  $e->content;        
    }
    
    //echo $title;
    include 'addi.php';
    
    
    
    
}
?>





