<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<header class="page_header">
    <div class="container">
  
        <?php
            $page_title = $page['title'];
            $page_subtitle = $page['subtitle'];
            $page_name = $page['name']; ?>

            <h3 class="sec-subtitle wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s"><?php echo $page['subtitle']; ?></h3>
            <h1 class="sec-title wow fadeInUp" itemprop="name" data-wow-duration="1s" data-wow-delay="1s"><?php echo $page['title']; ?></h1>
            <?php
        ///*if($page_subtitle != "") echo "<p class=\"lead mb0\">".$page_subtitle."</p>"; 
        ?> 
  
    </div>
</header> 
