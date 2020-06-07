<?php
if($article_alias == '') err404();
$book_ref = '';
$facility_counter = 0;
$result = $db->query('SELECT * FROM pm_room WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
if($result !== false && $db->last_row_count() > 0){
    
    $room = $result->fetch(PDO::FETCH_ASSOC);
    
    $room_id = $room['id'];
    $article_id = $room_id;
    $title_tag = $room['title'].' - '.$title_tag;
    $page_title = $room['title'];
    $page_subtitle = '';
    $page_alias = $pages[$page_id]['alias'].'/'.text_format($room['alias']);

    $meta_descr = $room['descr'];
    
    $result_room_file = $db->query('SELECT * FROM pm_room_file WHERE id_item = '.$room_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    if($result_room_file !== false && $db->last_row_count() > 0){
        
        $row = $result_room_file->fetch();
        
        $file_id = $row['id'];
        $filename = $row['file'];
        
        if(is_file(SYSBASE.'medias/room/big/'.$file_id.'/'.$filename))
            $page_img = getUrl(true).DOCBASE.'medias/room/big/'.$file_id.'/'.$filename;
    }
    
}else err404();

check_URI(DOCBASE.$page_alias);

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$javascripts[] = DOCBASE.'js/plugins/sharrre/jquery.sharrre.min.js';

$javascripts[] = DOCBASE.'js/plugins/jquery.event.calendar/js/jquery.event.calendar.js';
$javascripts[] = DOCBASE.'js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.'.LANG_TAG.'.js';
$stylesheets[] = array('file' => DOCBASE.'js/plugins/jquery.event.calendar/css/jquery.event.calendar.css', 'media' => 'all');



require(getFromTemplate('common/send_comment.php', false));

require(getFromTemplate('common/header.php', false)); ?>

<main id="page" class="pg-single-room">
    
    <div id="content">
        <h3 class="sec-subtitle">
            <?php echo $room['subtitle']; ?>
        </h3> 
        <h2 class="sec-title">
            <?php echo $room['title']; ?>
        </h2>
        <?php
            $result_room_file = $db->query('SELECT * FROM pm_room_file WHERE id_item = '.$room_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank');

            $bulletClass = "";
            if($db->last_row_count() <= 1){
                $bulletClass = "oneImg";
            }

        ?>
        <div class="imgSlider <?= $bulletClass; ?>" data-rtl="<?php echo (RTL_DIR) ? 'true' : 'false'; ?>">
            <div class="container">
                <div class="imgSlider__wrapper">
                <?php
                $result_room_file = $db->query('SELECT * FROM pm_room_file WHERE id_item = '.$room_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank');
                if($result_room_file !== false){
                    
                    foreach($result_room_file as $i => $row){
                    
                        $file_id = $row['id'];
                        $filename = $row['file'];
                        $label = $row['label'];
                        
                        $realpath = SYSBASE.'medias/room/big/'.$file_id.'/'.$filename;
                        $zoompath = DOCBASE.'medias/room/big/'.$file_id.'/'.$filename;
                        

                        img_crop($realpath, SYSBASE.'medias/slide/other/'.$file_id, 540, 465);

                        $custompath = DOCBASE.'medias/slide/other/'.$file_id.'/'.$filename;

                        if(is_file($realpath)){ ?>
                            <picture> 
                            <source media="(max-width: 900px)" srcset="<?= $zoompath; ?>">
                            <img alt="<?php echo $label; ?>" src="<?php echo $zoompath; ?>" "/>
                            </picture>
                            <?php
                        }
                    }
                } ?>
                <?php if($room['upload_3dimage'] != '' && $room['upload_3dimage'] !== null) : ?>
                <div class="view-3d-label">
                    <?php $path3d = DOCBASE.'medias/room/big/'.$room['upload_3dimage']; ?>
                    <!-- <img src="<?= $path3d ?>" /> -->
                    <img src="<?= DOCBASE ?>templates/hotel-template/images/3D-view-icon.svg" class="view-3d-icon" />
                    <span>3D view</span>
                </div>
                <?php require(getFromTemplate('common/3d-popup.php', false)); ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="single-body">
            <div class="container">

                <aside class="single-sidebar">
                    <ul class="single__details">
                        <li><img src="<?= DOCBASE ?>templates/hotel-template/images/adults-icon.svg" class="size-icon" /><span class="room-size-label">Adults:</span><span class="num room-size-value"><?= $room['max_adults'] ?></span></li>
                        <li><img src="<?= DOCBASE ?>templates/hotel-template/images/children-icon.svg" class="size-icon" /><span class="room-size-label">Children:</span><span class="num room-size-value"><?= $room['max_children'] ?></span></li>
                        <li><img src="<?= DOCBASE ?>templates/hotel-template/images/price-tag-icon.svg" class="size-icon" /><span class="room-size-label">Price From:</span><span class="num room-size-value"><?= formatPrice($room['price']*CURRENCY_RATE); ?></span></li>
                        <li><img src="<?= DOCBASE ?>templates/hotel-template/images/room-size-icon.svg" class="size-icon" /><span class="room-size-label">Room size:</span><span class="num room-size-value"><?= $room['room_size'] ?></span></li>
                    </ul>
                </aside>

                <div class="single-main"> 
                   
                        <?php
                        echo $room['descr'];
                        
                        $short_text = strtrunc(strip_tags($room['descr']), 100);
                        $site_url = getUrl(); ?>
                        
                        <?php 

    
                       $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$room['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                        if($result_facility !== false && $db->last_row_count() > 0){ ?>              
                
                        <?php
                        

                            foreach($result_facility as $i => $row){
                                $facility_id 	= $row['id'];
                                $facility_name  = $row['name'];

                                $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                if($result_facility_file !== false && $db->last_row_count() > 0){

                                    //var_dump($facility_counter);
                                    if($facility_counter == 0){ ?>
                                    <h5>The package includes:</h5>
                                    <ul class="items-3">
                                    <?php }
                                    $row = $result_facility_file->fetch();
                                    
                                    $file_id 	= $row['id'];
                                    $filename 	= $row['file'];
                                    $label	 	= $row['label'];
                                    
                                    $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                    $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                        
                                    if(is_file($realpath)){ ?>
                                        <li class="facility-icon">
                                            <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>" class="tips">
                                        </li>
                                        <?php
                                    }
                                    $facility_counter ++;
                                }
                                
                                
                            }
                        ?>
                        
                        <?php } 

                        if($facility_counter >= 0) echo "</ul>";
                        $room_title = $room['title'];
                        ?>
                        <div class="list-footer">
                        <a href="/rooms" class="back-link"><i class="icon-left-arrow"></i><span>Back to rooms</span></a>
                        <?php require(getFromTemplate('common/book-popup.php', false)); ?>
                        <?php if($room['book_option'] == 'engine') : ?>
                            <?= $room['widget_code'] ?>
                        <?php else: ?> 
                        <a href="<?= $book_ref ?>" class="book-room-<?= $room['book_option'] ?> btn btn-green"><span>Book</span></a>
                        <?php endif; ?>
                        </div>

                    </div>
                </div> 
            </div>
        </div> 
    </div>
</main>
