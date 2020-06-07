<?php
// $stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
// $javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
// $javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";

// $stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
// $javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";

require(getFromTemplate("common/header.php", false)); ?>

<main id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content">

        <?php
        $lz_offset = 1;
        $lz_limit = 9;
        $lz_pages = 0;
        $num_records = 0;
        $result = $db->query("SELECT count(*) FROM pm_offer WHERE checked = 1 AND lang = ".LANG_ID);
        if($result !== false){
            $num_records = $result->fetchColumn(0);
            $lz_pages = ceil($num_records/$lz_limit);
        }
        if($num_records > 0){ ?>
                <?php include(getFromTemplate("common/get_offers.php", false)); ?>
            <?php
        } ?>

    </div>
</main>

