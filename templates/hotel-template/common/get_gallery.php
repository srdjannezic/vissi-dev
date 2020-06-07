<?php

if(isset($_POST['ajax']) && $_POST['ajax'] == 1){
    
    require_once("../../../common/lib.php");
    require_once("../../../common/define.php"); 

    if(isset($_POST['page_id']) && is_numeric($_POST['page_id'])
    && isset($_POST['page_alias'])){
        $page_id = $_POST['page_id'];
        $page_alias = $_POST['page_alias'];
    }
}
if(isset($db) && $db !== false){ 
    $html = ""; 

    if(isset($page_id) && isset($pages[$page_id]['alias'])) $page_alias = $pages[$page_id]['alias'];

    $result_article = $db->query("SELECT * FROM pm_article WHERE id_page = ".$page_id." AND checked = 1 AND (publish_date IS NULL || publish_date <= ".time().") AND (unpublish_date IS NULL || unpublish_date > ".time().") AND lang = ".LANG_ID." ORDER BY rank");
    if(!isset($_GET['id'])){
        $gallery = $result_article->fetch();
        $article_id = $gallery['id'];
    }
    else{
        $article_id = $_GET['id'];
    }

    $result_article_file = $db->prepare("SELECT * FROM pm_article_file WHERE id_item = :article_id AND checked = 1 AND lang = ".LANG_ID." AND type = 'image' AND file != '' ORDER BY rank");
    $result_article_file->bindParam(":article_id", $article_id);
    if($result_article_file->execute() !== false && $db->last_row_count() > 0){
    	$html .= "
        <div id='sliderContainer'>
            <div class='royalSlider centerArrow rsMinW fullSized clearfix rsDefault thumbs'>";

        foreach ($result_article_file->fetchAll() as $value) {
            $file_id = $value['id'];
            $filename = $value['file'];
            $zoompath = DOCBASE.'medias/article/big/'.$file_id.'/'.$filename;
            $thumbspath = DOCBASE.'medias/article/small/'.$file_id.'/'.$filename;

            $html .= "<div class='rsContent'>
                <img class='rsImg' src='" . $zoompath . "'>";
            $html .= "<div class=\"rsTmb\">
             <img class='rsTmb' src='" . $zoompath . "'>
            </div>
            </div>";    		
    	}
        $html .= 
            "</div>
        </div>";
	}

    echo $html;
}

?>