<?php
require(getFromTemplate("common/header.php", false)); 

//var_dump($page_id);
?>

<main id="page"> 
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content">
            <!--teaser-->    
            <section class="teaser">
                <div class="container">
                    <?php 
                    $where = "WHERE lang = " . LANG_ID . " AND type = 'image' AND id_item = " . $page_id;
                    $num_rows = numRows($db, 'pm_page_file', $where );
                    $bulletClass = "";
                    if($num_rows <= 1){
                        $bulletClass = "oneImg";
                    }
                    ?>
                    <div class="imgSlider <?= $bulletClass ?>">
                        <div class="imgSlider__wrapper s-play">
                            <?php 
                            getImagesFromTable($db,'pm_page_file','page',$page_id);
                             ?>
                        </div>
                    </div>
                    <div class="teaser__content">
                        <h3><?= $page['intro']; ?></h3>
                        <?= $page['text']; ?>
                    </div>
                </div>
            </section>
    </div>
</main>
