<?php
/**
 * Script called (Ajax) on scroll or click
 * loads more content with Lazy Loader
 */
$html = '';
if(!isset($lz_offset)) $lz_offset = 1;
if(!isset($lz_limit)) $lz_limit = 30;
if(isset($_POST['ajax']) && $_POST['ajax'] == 1){
    
    require_once('../../../common/lib.php');
    require_once('../../../common/define.php');

    if(isset($_POST['offset']) && is_numeric($_POST['offset'])
    && isset($_POST['limit']) && is_numeric($_POST['limit'])
    && isset($_POST['page_id']) && is_numeric($_POST['page_id'])
    && isset($_POST['page_alias'])){
        $page_id = $_POST['page_id'];
        $lz_offset = $_POST['offset'];
        $lz_limit =	$_POST['limit'];
        $page_alias = $_POST['page_alias'];
    }
}
if(isset($db) && $db !== false){
    
    if(isset($page_id) && isset($pages[$page_id]['alias'])) $page_alias = $pages[$page_id]['alias'];

    $result_offer = $db->query('SELECT * FROM pm_offer WHERE lang = '.LANG_ID.' AND checked = 1 ORDER BY rank LIMIT '.($lz_offset-1)*$lz_limit.', '.$lz_limit);

    $offer_id = 0;

    $result_offer_file = $db->prepare('SELECT * FROM pm_offer_file WHERE id_item = :offer_id AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank');
    $result_offer_file->bindParam(':offer_id', $offer_id);

    $result_rate = $db->prepare('SELECT MIN(price) as price FROM pm_rate WHERE id_offer = :id_offer');
    $result_rate->bindParam(':id_offer', $offer_id);

    $offer_pos = "left-side";
    $content_pos = "slider__left";
    $image_pos = "slider__right";

    $current = 0;

    foreach($result_offer as $i => $row){
                                
        $offer_id = $row['id'];
        $offer_title = $row['title'];
        $offer_subtitle = $row['subtitle'];
        $offer_price = $row['price'];
        $offer_alias = $row['alias'];
        $content = strWordCut(checkIsset($row['descr']), 180); 
        $max_people = checkIsset($row['max_people']);
        $min_people = checkIsset($row['min_people']);
        $max_children = checkIsset($row['max_children']);
        $night_stay = checkIsset($row['min_nights']);
        
        $offer_alias = DOCBASE.$page_alias.'/'.text_format($offer_alias);

            
        if($current % 2 == 0){
            $offer_pos = "left-side";
            $content_pos = "slider__left";
            $image_pos = "slider__right";
        }
        else{
            $offer_pos = "right-side";
            $content_pos = "slider__right";
            $image_pos = "slider__left";
        }

        $html .= '
        <article class="content-slider '.$offer_pos.' wow fadeInUp" data-wow-duration="0.6s" data-wow-delay="0.5s" data-wow-offset="100">';

            if($result_offer_file->execute() !== false && $db->last_row_count() > 0){
                $html .= '
                <div class="content-'.$content_pos.'">
                    <div class="container">
                        <div class="content-holder">
                            <a href="'.$offer_alias.'"><h3 itemprop="name">'.$offer_title.'</h3></a>';
                            $min_price = $offer_price;
                            if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                $row = $result_rate->fetch();
                                $price = $row['price'];
                                if($price > 0) $min_price = $price;
                            }
                            $html .= '

                            <ul class="room-details">
                                <li><i class="icon-moon"></i><span class="cen-vertical">'.$night_stay.'</span></li>
                                <li><i class="icon-person"></i><span class="cen-vertical">'.$min_people.'</span></li>

                            <li class="prices">
                                <span class="cen-vertical">'.$texts['FROM_PRICE'].'</span>
                                <span itemprop="priceRange" class="num">
                                    '.formatPrice($min_price*CURRENCY_RATE).'
                                </span>
                            </li>
                            </ul>
                            <p>'.$content.'</p>
                            <div class="btn-holder">
                                <a href="'.$offer_alias.'" class="btn btn-green"><span>'.$texts['BOOK_NOW'].'</span></a>
                            </div>
                   
                        </div>
                    </div>
                </div>';
                $bulletClass = "";

                if($db->last_row_count() == 1){
                    $bulletClass = "oneImg";
                }
                $html .= "<div class='imgSlider content-".$image_pos." ".$bulletClass."'><div class='imgSlider__wrapper s-play'>";
                
                    foreach($result_offer_file->fetchAll(PDO::FETCH_ASSOC) as $row){
                        //var_dump('test');
                        $file_id = $row['id']; 
                        $filename = $row['file'];
                        $label = $row['label'];
                        
                        $realpath = SYSBASE.'medias/offer/big/'.$file_id.'/'.$filename;
                        $thumbpath = DOCBASE.'medias/offer/medium/'.$file_id.'/'.$filename;
                        $zoompath = DOCBASE.'medias/offer/big/'.$file_id.'/'.$filename;
                        

                        img_crop($realpath, SYSBASE.'medias/slide/other/'.$file_id, 540, 465);

                        $custompath = DOCBASE.'medias/slide/other/'.$file_id.'/'.$filename;

                        if(is_file($realpath)){
                            $html .= '<a itemprop="url" href="'.$offer_alias.'">';
                            $html .= '
                                <figure class="img-container">
                                <picture> 
                                <source media="(max-width: 900px)" srcset="'.$zoompath.'">
                                    <img alt="'.$label.'" src="'.$zoompath.'">
                                </picture>
                                </figure>';
                            $html .= '</a>';
                        }
                    }
                $html .= "</div></div>";
            }
            $html .= '</article>';



        $current ++;

    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
        echo json_encode(array('html' => $html));
    else
        echo $html;
}
