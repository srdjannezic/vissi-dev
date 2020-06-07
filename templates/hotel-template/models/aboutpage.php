<?php
/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */

// $stylesheets[] = array('file' => DOCBASE.'js/plugins/isotope/css/style.css', 'media' => 'all');
// $javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js';
// $javascripts[] = DOCBASE.'js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js';

// $stylesheets[] = array('file' => DOCBASE.'js/plugins/lazyloader/lazyloader.css', 'media' => 'all');
// $javascripts[] = DOCBASE.'js/plugins/lazyloader/lazyloader.js';

// $stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/css/star-rating.min.css', 'media' => 'all');
// $javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/js/star-rating.min.js';

// $stylesheets[] = array('file' => DOCBASE.'js/plugins/royalslider/royalslider.css', 'media' => 'all');
// $stylesheets[] = array('file' => DOCBASE.'js/plugins/royalslider/skins/minimal-white/rs-minimal-white.css', 'media' => 'all');
// $javascripts[] = DOCBASE.'js/plugins/royalslider/jquery.royalslider.min.js';

require(getFromTemplate('common/send_comment.php', false));

require(getFromTemplate('common/header.php', false)); 

$widget = getWidgets('left', $page_id);

$w = $widget['left'][0];


?>

<main id="page" class="pg-about">

    <?php include(getFromTemplate('common/page_header.php', false)); ?>

    <div id="content">
        <!--teaser-->    
        <section class="teaser">
            <div class="container">
                <?php 
                //var_dump('test');
                $where = "WHERE lang = " . LANG_ID . " AND type = 'image' AND id_item = " . $page_id;
                $num_rows = numRows($db, 'pm_page_file', $where );
                $bulletClass = "";
                if($num_rows <= 1){
                    $bulletClass = "oneImg";
                }
                ?>
                <div class="imgSlider <?= $bulletClass ?>">
                    <div class="imgSlider__wrapper s-play">
                        <?php getImagesFromTable($db,'pm_page_file','page', $page_id,false,5); ?>
                    </div>
                </div>
                <div class="teaser__content">
                    <h3><?= $page['intro']; ?></h3>
                    <?= $page['text']; ?>
                </div>
            </div>
        </section>

        <!--Our story-->
        <section class="our-story">
            <div class="container">
                <article class="our-story__box">
                    <div class="inner-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <?= $w['content']; ?>
                    </div>
                </article>
                <article class="our-story__box">
                    <div class="inner-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <?= $w['text1']; ?>
                    </div>
                </article>
            </div>
            <div class="bgHolder">
                <div class="bg-left"></div>
                <div class="bg-right"></div>
            </div>    
        </section>
                
        <!--teaser-->    
        <section class="teaser">
            <div class="container">
                <?php 
                $where = "WHERE lang = " . LANG_ID . " AND type = 'image'";
                $num_rows = numRows($db, 'pm_room_file', $where );
                $bulletClass = "";
                if($num_rows <= 1){
                    $bulletClass = "oneImg";
                }
                ?>
                <div class="imgSlider <?= $bulletClass; ?>">
                    <div class="imgSlider__wrapper s-play">
                        <?php getImagesFromTable($db,'pm_room_file','room',false,5); ?>
                    </div>
                </div>
                <div class="teaser__content">
                    <?= $w['text2']; ?>
                </div>
            </div>
        </section>
    </div>
</main>
