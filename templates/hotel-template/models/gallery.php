<?php
/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
if($article_id > 0){
    
    $title_tag = $article['title']." - ".$title_tag;
    $page_title = $article['title'];
    $page_subtitle = $article['subtitle'];
    $page_alias = $article['alias'];
    $publish_date = $article['publish_date'];
    $edit_date = $article['edit_date'];
}

$gallery_id = 4;
if(isset($_GET['id'])){
    $gallery_id = $_GET['id'];
}

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

require(getFromTemplate('common/header.php', false)); ?>

<main id="page">

    <?php include(getFromTemplate('common/page_header.php', false)); ?>

    <div id="content">


        <div class="alert alert-success" style="display:none;"></div>
        <div class="alert alert-danger" style="display:none;"></div>
        

            <?php
            $result = $db->query('SELECT count(*) FROM pm_article WHERE id_page = '.$page_id.' AND checked = 1 AND (publish_date IS NULL || publish_date <= '.time().') AND (unpublish_date IS NULL || unpublish_date > '.time().') AND lang = '.LANG_ID);
            if($result !== false){
                $num_records = $result->fetchColumn(0);
            }
            if($num_records > 0){?>
                <!--gallery categories-->
                <nav class="gallery-categories">
                    <ul class="" data-loader="<?php echo getFromTemplate('common/get_galleries.php'); ?>" data-mode="click" data-more_caption="<?php echo $texts['LOAD_MORE']; ?>" data-is_isotope="true" data-variables="page_id=<?php echo $page_id; ?>&page_alias=<?php echo $page['alias']; ?>">
                        <?php include(getFromTemplate('common/get_galleries.php', false)); ?>
                    </ul>
                </nav>
                <!--gallery slider-->
                <div class="gallery-slider">
                    <section class="teaser">
                        <div class="container">
                            <?php 
                            $where = "WHERE lang = " . LANG_ID . " AND type = 'image' AND id_item = '".$gallery_id."'";
                            $num_rows = numRows($db, 'pm_article_file', $where );
                            $bulletClass = "";
                            if($num_rows <= 1){
                                $bulletClass = "oneImg";
                            }
                            ?>
                            <div class="imgSlider <?= $bulletClass; ?>">
                                <div class="imgSlider__wrapper s-play">
                                    <?php getImagesFromTable($db, 'pm_article_file', 'article', $gallery_id); ?> 
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php
            } ?>
        </div>
            
    </div>
</main>
