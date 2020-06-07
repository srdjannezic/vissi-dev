<?php
// $stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
// $javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
// $javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";


// $stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
// $javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";

require(getFromTemplate("common/header.php", false)); 

?>
<main id="page" class="pg-rooms-suites">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content">
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
                        <h3><?= $page['intro']; ?></h3>
                        <?= $page['text']; ?>
                    </div>
                </div>
            </section>
            <!-- facilitys -->
            <section id="facility" class="prim-section">
                <div class="container">
                    <h4 class="sec-subtitle">why choose our hotel</h4>
                    <h2 class="sec-title">AMENITIES HIGHLIGHTS</h2>
                    <div class="facility__items">
                        <?php listItemsInColumns($db, array('table'=>'facility','columns'=>3), $texts); ?>
                    </div>
                </div>
            </section>
            <!--room list--> 
            <section class="teaser-list">
                <div class="container">
                    <?php
                    $lz_offset = 1;
                    $lz_limit = 1000;
                    $lz_pages = 0;
                    $num_records = 0;
                    $result = $db->query("SELECT count(*) FROM pm_room WHERE checked = 1 AND lang = ".LANG_ID);
                    if($result !== false){
                        $num_records = $result->fetchColumn(0);
                        $lz_pages = ceil($num_records/$lz_limit);
                    }
                    if($num_records > 0){ ?>
                        
                        <?php include(getFromTemplate("common/get_rooms.php", false)); ?>
             
                        <?php
                    } ?>
                    
                </div>
            </section>

    </div>
</main>
