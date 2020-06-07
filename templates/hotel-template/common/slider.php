   <?php

    $arrowClass = "bottomArrow";
    if($appearance['arrow_position'] == 1){
        $arrowClass = "centerArrow";
    }

    $slide_id = 0;
    $result_slide_file = $db->prepare('SELECT * FROM pm_slide_file WHERE id_item = :slide_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    $result_slide_file->bindParam('slide_id', $slide_id);

    $result_slide = $db->query('SELECT * FROM pm_slide WHERE id_page = '.$page_id.' AND checked = 1 AND lang = '.LANG_ID.' ORDER BY rank', PDO::FETCH_ASSOC);
    if($result_slide !== false){
        $nb_slides = $db->last_row_count();
        if($nb_slides > 0){ ?>
            <div id="sliderContainer">
                
                <div class="royalSlider <?= $arrowClass; ?> rsMinW fullSized clearfix">
                    <?php
                    foreach($result_slide as $i => $row){
                        $slide_id = $row['id'];
                        $slide_legend = $row['legend'];
                        $url_video = $row['url'];
                        $id_page = $row['id_page'];
                        
                        $result_slide_file->execute();
                        
                        if($result_slide_file !== false && $db->last_row_count() > 0){
                            $row = $result_slide_file->fetch();
                            
                            $file_id = $row['id'];
                            $filename = $row['file'];
                            $label = $row['label'];
                            
                            $realpath = SYSBASE.'medias/slide/big/'.$file_id.'/'.$filename;
                            $thumbpath = DOCBASE.'medias/slide/small/'.$file_id.'/'.$filename;
                            $zoompath = DOCBASE.'medias/slide/big/'.$file_id.'/'.$filename;
                                
                            if(is_file($realpath)){ ?>
                            
                                <div class="rsContent">
                                    <img class="rsImg" src="<?php echo $zoompath; ?>" alt=""<?php if($url_video != '') echo ' data-rsVideo="'.$url_video.'"'; ?>>
                                    <?php
                                    if($slide_legend != ''){ ?>
                                        <div class="infoBlock" data-fade-effect="" data-move-offset="10" data-move-effect="bottom" data-speed="200">
                                            <?php echo $slide_legend; ?>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                                <?php
                            }
                        }
                    } ?>
                </div>
            <?php
        }
    } ?>    