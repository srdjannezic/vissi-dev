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

    $result_room = $db->query('SELECT * FROM pm_room WHERE lang = '.LANG_ID.' AND checked = 1 ORDER BY rank LIMIT '.($lz_offset-1)*$lz_limit.', '.$lz_limit);

    $room_id = 0;

    $result_room_file = $db->prepare('SELECT * FROM pm_room_file WHERE id_item = :room_id AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    $result_room_file->bindParam(':room_id', $room_id);

    $result_rate = $db->prepare('SELECT MIN(price) as price FROM pm_rate WHERE id_room = :id_room');
    $result_rate->bindParam(':id_room', $room_id);

    foreach($result_room as $i => $row){
                                
        $room_id = $row['id'];
        $room_title = $row['title'];
        $room_subtitle = $row['subtitle'];
        $room_price = $row['price'];
        $room_alias = $row['alias'];
        $content = substr($row['descr'],0,300);

        if(strlen($row['descr']) > 300){
            $content .= '...';
        }

        $book_option = $row['book_option'];
        $widget_code = $row['widget_code'];
        $room_alias = DOCBASE.$page_alias.'/'.text_format($room_alias);
        
        $html .= '
        <article class="listBox wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <a itemprop="url" href="'.$room_alias.'">';
                    
                    if($result_room_file->execute() !== false && $db->last_row_count() > 0){
                        $row = $result_room_file->fetch(PDO::FETCH_ASSOC);
                        
                        $file_id = $row['id'];
                        $filename = $row['file'];
                        $label = $row['label'];
                        
                        $realpath = SYSBASE.'medias/room/big/'.$file_id.'/'.$filename;
                        $thumbpath = DOCBASE.'medias/room/medium/'.$file_id.'/'.$filename;
                        $zoompath = DOCBASE.'medias/room/big/'.$file_id.'/'.$filename;
                        
                        img_crop($realpath, SYSBASE.'medias/slide/other/'.$file_id, 540, 465);
 
                        $custompath = DOCBASE.'medias/slide/other/'.$file_id.'/'.$filename;

                        if(is_file($realpath)){
                            $html .= '
                            <figure class="more-link img-container">
                            <picture> 
                                <source media="(max-width: 900px)" srcset="'.$zoompath.'">
                                <img alt="'.$label.'" src="'.$zoompath.'">
                            </picture>
                            </figure>';
                        }
                    }
                    $html .= '
                </a>
                    <div class="listBox__content">
                        <h4>'.$room_subtitle.'</h4>
                        <a itemprop="url" href="'.$room_alias.'">
                        <h3 itemprop="name">'.$room_title.'</h3></a>';
                        $min_price = $room_price;
                        if($result_rate->execute() !== false && $db->last_row_count() > 0){
                            $row = $result_rate->fetch();
                            $price = $row['price'];
                            if($price > 0) $min_price = $price;
                        }
                        $html .= '
                            <div class="prices">
                                <span class="cen-vertical">'.$texts['FROM_PRICE'].'</span>
                                <span itemprop="priceRange" class="num">
                                    '.formatPrice($min_price*CURRENCY_RATE).'
                                </span>
                            </div>';
                            $html .= '<div class="teaser-content"><div class="teaser-text">'.$content.'</div></p></div>';
                            $html .= '<div class="list-footer">
                            <a href="'.$room_alias.'" class="link-more"><span>See more</span><i class="icon-right-arrow"></i></a>';

                            if($widget_code != ''){
                             $html .= $widget_code;

                        	}
                            else{
                                $html .= '<a class="book-room-' . $book_option . ' btn btn-green"><span>BOOK</span></a>';
                            }
                        //}

                       $html .= '<div id="bookPopUp" class="hide popup-box">

    <div id="bookScroller">

        <div id="bookPopUpHeader">

            <h3>Please fill in your data and our representative<br/>will get back to you.</h3>

            

            <div class="alert alert-success" style="display:none;"></div>

            <div class="alert alert-danger" style="display:none;"></div>

        </div>

        <div id="bookPopUpContent">

            <form name="bookPopUp" action="' . DOCBASE . 'send-mail" method="post" class="booking-search">
                <input type="hidden" name="room" value="' . $room_title . '">
                <div class="form-group form-drop">

                    <div class="input-group">

                        <select name="gender" class="selectpicker form-control">

                            <option value="Mr">Mr</option>

                            <option value="Mrs">Mrs</option>

                        </select>

                    </div>

                    <i class="icon-arrow-down"></i>

                </div>

                <div class="form-group">

                    <div class="input-wrapper">

                        <input type="text" name="name" value="" placeholder="Name *" class="required">

                    </div>

                </div>

                <div class="form-group">

                    <div class="input-wrapper">

                        <input type="text" name="surname" value="" placeholder="Surname">

                    </div>

                </div>

                <div class="form-group">

                    <div class="input-wrapper">

                        <input type="text" name="phone" value="" placeholder="Telephone *" class="required">

                    </div>

                </div>

                <div class="form-group">

                    <div class="input-wrapper">

                        <input type="email" name="email" value="" placeholder="E-mail *" class="required">

                    </div>

                </div>

                <div class="input-wrapper pick-date input-date-wrapper date-left">

                    <span class="icon-calendar"></span>

                    <input type="text" class="form-control from-popup" id="from-popup" name="from" placeholder="Start date" autocomplete="off" readonly>

                    <div class="fromDatePopUp-holder">

                    </div>

                </div>

                <div class="input-wrapper pick-date input-date-wrapper date-left">

                    <span class="icon-calendar"></span>

                    <input type="text" class="form-control to-popup" id="to-popup" name="to" placeholder="Start date" autocomplete="off" readonly>

                    <div class="toDatePopUp-holder">

                    </div>

                </div>

                <!-- START DATE -- END DATE -->

                <div class="form-group form-drop">

                    <div class="input-group">

                        <select name="peoples" class="selectpicker form-control">

                            <option>Number of people</option>

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                        </select>

                    </div>

                    <i class="icon-arrow-down"></i>

                </div>



                <div class="form-group">

                    <div class="input-wrapper">

                        <input type="text" name="reason" placeholder="Subject" />


                    </div>

                </div>

                <div class="form-group">

                    <div class="input-wrapper text-message">

                        <textarea name="msg" placeholder="Your remarks / request" rows="4"></textarea>

                    </div>

                    <div class="field-notice" rel="msg"></div>

                </div> 

                <div class="form-group">

                    <div class="input-wrapper">

                        <span class="contact-ask">Do you want to be contacted via</span>

                        <div class="contact-unit">



                            <div class="check-row">

                                <input type="checkbox" class="css-checkbox" name="contacted" id="checkbox-phone-'.$room_id.'" value=""/>

                                <label class="label-container css-label" for="checkbox-phone-'.$room_id.'"></label>

                                <span class="check-desc">Phone</span>

                            </div>

                            <div class="check-row">

                                <input type="checkbox" class="css-checkbox" name="contacted" id="checkbox-email-'.$room_id.'" value=""/>

                                <label class="label-container css-label" for="checkbox-email-'.$room_id.'"></label>

                                <span class="check-desc">Email</span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-group submit-row">       

                    <button type="submit" class="submit-contact btn btn-green"><span>Submit</span></button>

                </div>

            </form>

        </div>

    </div>

</div>';
               

                    $html .= '</div></div>
              
        </article>';
    }

    if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
        echo json_encode(array('html' => $html));
    else
        echo $html;
}