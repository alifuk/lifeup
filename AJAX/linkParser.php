<?php

if (isset($_POST['link']) && $_POST['link'] != "" && isset($_POST['owner']) && $_POST['owner'] != "") {


    include('../simplehtmldom_1_5/simple_html_dom.php');

    $html = file_get_html($_POST['link']);
    $title = "";
    $image = "";
    foreach ($html->find('title') as $e) {
        $title = $e->innertext;
    }

    foreach ($html->find('meta[property="og:image"]') as $e) {
        $image = $e->content;
    }
    
    if (trim($image) == "") {
        foreach ($html->find('link[rel="shortcut icon"]') as $e) {
            $image = $e->href;
            echo "juuuuu";
            if(strrpos($image, "/") == 0){
                
                $texkaPos = strrpos($_POST['link'], ".",-1);
                $adresaEnd = 0;
                if(strpos($_POST['link'], "/",$texkaPos) == -1){
                    $image = $_POST['link'].$image;
                } else{
                    echo $texkaPos . "  ";
                    echo substr($_POST['link'], 0, strpos($_POST['link'], "/",$texkaPos));
                    $image = substr($_POST['link'], 0, strpos($_POST['link'], "/",$texkaPos)) .$image ;
                }
                
            }
        }
    }
    
    if (trim($image) == "") {
        foreach ($html->find('link[rel="icon"]') as $e) {
            
            $image = $e->href;
            echo "juuuuu";
            if(strrpos($image, "/") == 0){
                
                $texkaPos = strrpos($_POST['link'], ".",-1);
                $adresaEnd = 0;
                if(strpos($_POST['link'], "/",$texkaPos) == -1){
                    $image = $_POST['link'].$image;
                } else{
                    echo $texkaPos . "  ";
                    echo substr($_POST['link'], 0, strpos($_POST['link'], "/",$texkaPos));
                    $image = substr($_POST['link'], 0, strpos($_POST['link'], "/",$texkaPos)) .$image ;
                }
                
            }
            
            
        }
    }
    echo $image;
    include 'addi.php';
}
?>





