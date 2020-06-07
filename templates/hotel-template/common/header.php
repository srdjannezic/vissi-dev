<?php debug_backtrace() || die ("Direct access not permitted"); ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">



    <title><?php echo $title_tag; ?> - <?= SITE_TITLE ?></title>



    <?php

    //var_dump($page);



    if($page_img === NULL){

        if(isset($appearance['og_image'] ) ) {

            $page_img = $appearance['og_image'];

        }

    }



    if(isset($article)) $meta_descr = strtrunc(strip_tags($article['text']), 155);

    elseif(isset($meta_descr)) $meta_descr = strtrunc(strip_tags($meta_descr), 155); 

    elseif($page['descr'] != "") $meta_descr = $page['descr'];

    else $meta_descr = strtrunc(strip_tags($page['text']), 155); ?>



    <meta name="description" content="<?php echo $meta_descr; ?>">

    

    <!-- Schema.org markup for Google+ -->

    <meta itemprop="name" content="<?php echo $title_tag; ?>">

    <meta itemprop="description" content="<?php echo $meta_descr; ?>">

    <?php

    if(isset($page_img)){ ?>

        <meta itemprop="image" content="<?php echo $page_img; ?>">

        <?php

    } ?>

    

    <!-- Open Graph data -->

    <meta property="og:title" content="<?php echo $title_tag; ?>">

    <meta property="og:type" content="article">

    <meta property="og:url" content="<?php echo getUrl(); ?>">

    <?php

    if(isset($page_img)){ ?>

        <meta property="og:image" content="<?php echo $page_img; ?>">

        <?php

    } ?>

    <meta property="og:description" content="<?php echo $meta_descr; ?>">

    <meta property="og:site_name" content="<?php echo SITE_TITLE; ?>">

    <?php

    if(isset($publish_date) && isset($edit_date)){ ?>

        <meta property="article:published_time" content="<?php echo date("c", $publish_date); ?>">

        <meta property="article:modified_time" content="<?php echo date("c", $edit_date); ?>">

        <?php

    } ?>

    <?php

    if($article_id > 0){ ?>

        <meta property="article:section" content="<?php echo $page['title']; ?>">

        <?php

    } ?>

    <?php

    if(isset($article_tags) && $article_tags != ""){ ?>

        <meta property="article:tag" content="<?php echo $article_tags; ?>">

        <?php

    } ?>

    <meta property="article:author" content="<?php echo OWNER; ?>">



    <!-- Twitter Card data -->

    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:site" content="@publisher_handle">

    <meta name="twitter:title" content="<?php echo $title_tag; ?>">

    <meta name="twitter:description" content="<?php echo $meta_descr; ?>">

    <meta name="twitter:creator" content="@author_handle">

    <?php

    if(isset($page_img)){ ?>

        <meta name="twitter:image:src" content="<?php echo $page_img; ?>">

        <?php

    } ?>

    

    <meta name="robots" content="<?php if($page['robots'] != "") echo $page['robots']; else echo "index, follow"; ?>">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    

    <?php

    if(AUTOGEOLOCATE){ ?>

        <meta name="autogeolocate" content="true">

        <?php

    }

    if(GMAPS_API_KEY != ""){ ?>

        <meta name="gmaps_api_key" content="<?php echo GMAPS_API_KEY; ?>">

        <?php

    } ?>





    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo getFromTemplate("images/favicons/Vissi D' Arte-logo-16x16px.png"); ?>">

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo getFromTemplate("images/favicons/Vissi D' Arte-logo-32x32px.png"); ?>">

    <link rel="icon" type="image/png" sizes="196x196" href="<?php echo getFromTemplate("images/favicons/Vissi D' Arte-logo-196x196px.png"); ?>">

    <link rel="icon" type="image/png" sizes="256x256" href="<?php echo getFromTemplate("images/favicons/Vissi D' Arte-logo-256x256px.png"); ?>">

    

    <link rel="manifest" href="<?php echo getFromTemplate("images/favicons/manifest.json"); ?>">

    <meta name="msapplication-TileColor" content="#ffffff">

    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

    <meta name="theme-color" content="#ffffff">

    

    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/bootstrap/css/bootstrap.min.css">

    <?php

    if(RTL_DIR){ ?>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">

        <?php

    } ?>

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,900" rel="stylesheet">

    

    <?php

    //CSS required by the current model

    if(isset($stylesheets)){

        foreach($stylesheets as $stylesheet){ ?>

            <link rel="stylesheet" href="<?php echo $stylesheet['file']; ?>" media="<?php echo $stylesheet['media']; ?>">

            <?php

        }

    } ?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

   <!--  <link rel="stylesheet" href="<?php //echo DOCBASE; ?>common/css/shortcodes.css"> -->

    <link rel="stylesheet" href="<?php echo getFromTemplate("css/style.css"); ?>?v=1.5">

    <link rel="stylesheet" href="<?php echo getFromTemplate("css/update.css"); ?>?v=1.3">

    <link rel="stylesheet" href="<?php echo DOCBASE; ?>js/plugins/wow/animate.css">

</head>

<?php

$sticky_class = "";

if(isset($appearance['header_sticky'])){

if($appearance['header_sticky'] == 1){

    $sticky_class = "navbar-fixed-top";

}

}

else{

    $appearance['header_type'] = null;

    $appearance['menu_position'] = null;

    $appearance['logo_position'] = null;

    $appearance['booking_search_position'] = null;

    $page_id = null;

}

?>

<body class="header-type-<?= $appearance['header_type'] ?> menu-position-<?= $appearance['menu_position'] ?> logo-position-<?= $appearance['logo_position'] ?> booking-search-position-<?= $appearance['booking_search_position'] ?>" id="page-<?php echo $page_id; ?>" <?php if(RTL_DIR) echo " dir=\"rtl\""; ?>>

<div id="book-overlay"></div>



<!-- Schema.org markup for Google+ -->

<meta itemprop="name" content="<?php echo htmlentities($title_tag, ENT_QUOTES); ?>">

<meta itemprop="description" content="<?php echo htmlentities($meta_descr, ENT_QUOTES); ?>">

<?php

if(isset($page_img)){ ?>

    <meta itemprop="image" content="<?php echo $page_img; ?>">

    <?php

} ?>



<!-- <div id="loader-wrapper"><div id="loader"></div></div> -->

<?php if(!isset($_GET['id'])) : ?>

<div id="overlay">

    <img src="<?php echo getFromTemplate("images/vissi-d-arte-white-logo.svg"); ?>" alt="">

</div>

<?php endif; ?>

<div id="page-wrapper">

<?php

if(ENABLE_COOKIES_NOTICE == 1 && !isset($_COOKIE['cookies_enabled'])){ ?>

    <div id="cookies-notice">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <?php echo $texts['COOKIES_NOTICE']; ?>

                    <button class="btn btn-success btn-xs">OK</button>

                </div>

            </div>

        </div>

    </div>

    <?php

} 





?>

<header class="<?= $sticky_class ?> header-type-<?= $appearance['header_type'] ?> logo-position-<?= $appearance['logo_position'] ?>" role="banner">

    <div id="mainHeader">

        <div class="container">

            <?php if($appearance['logo_position'] == 1 || $appearance['logo_position'] == 2 || $appearance['logo_position'] == 5) :             ?>

                <a class="navbar-brand" href="<?php echo DOCBASE.trim(LANG_ALIAS, "/"); ?>" title="<?php echo $homepage['title']; ?>"><img src="<?php echo getFromTemplate("images/vissi-d-arte-logo-brown.svg"); ?>" alt="<?php echo SITE_TITLE; ?>"></a>

            <?php endif; ?>

            <div id="mainMenu" class="menu-position-<?= $appearance['menu_position'] ?>">

                <div class="nav-wrapper">

                <ul class="nav navbar-nav">

                    <?php

                    function subMenu($id_parent, $menu)

                    { ?>

                        <span class="dropdown-btn visible-xs"></span>

                        <ul class="subMenu">

                            <?php

                            foreach($menu as $nav_id => $nav){

                                if($nav['id_parent'] == $id_parent){ ?>

                                    <li>

                                        <?php

                                        $hasChildNav = has_child_nav($nav_id, $menu); ?>

                                        <a class="<?php if($hasChildNav) echo "hasSubMenu"; ?>" href="<?php echo $nav['href']; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>

                                        <?php if($hasChildNav) subMenu($nav_id, $menu); ?>

                                    </li>

                                    <?php

                                }

                            } ?>

                        </ul>

                        <?php

                    }

                    

                    $top_nav_id = get_top_nav_id($menus['main']);

                    foreach($menus['main'] as $nav_id => $nav){

                        if(empty($nav['id_parent']) || @$menus['main'][$nav['id_parent']]['id_item'] == $homepage['id']){ ?>

                            <li class="primary nav-<?php echo $nav_id; ?>">

                                <?php

                                if($nav['item_type'] == "page" && $pages[$nav['id_item']]['home'] == 1){ ?>

                                    <a class="firstLevel<?php if($ishome) echo " active"; ?>" href="<?php echo DOCBASE.LANG_ALIAS; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>

                                    <?php

                                }else{

                                    $hasChildNav = has_child_nav($nav_id, $menus['main']); ?>

                                    <a class="dropdown-toggle disabled firstLevel<?php if($hasChildNav) echo " hasSubMenu"; if($top_nav_id == $nav_id) echo " active"; ?>" href="<?php echo $nav['href']; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>

                                    <?php if($hasChildNav) subMenu($nav_id, $menus['main']);

                                } ?>

                            </li>

                            <?php

                        }

                    } ?>



                    <?php /*

                    <li class="primary btn-nav">

                        <?php

                        if(isset($_SESSION['user'])){ ?>

                            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">

                                <div class="dropdown">

                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">

                                        <i class="fas fa-fw fa-user"></i>

                                        <span class="hidden-sm hidden-md">

                                            <?php

                                            if($_SESSION['user']['login'] != "") echo $_SESSION['user']['login'];

                                            else echo $_SESSION['user']['email']; ?>

                                        </span>

                                        <span class="fas fa-fw fa-caret-down"></span>

                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" id="user-menu">

                                        <?php

                                        if($_SESSION['user']['type'] == "registered"){ ?>

                                            <li><a href="<?php echo DOCBASE.$sys_pages['account']['alias']; ?>"><i class="fas fa-fw fa-user"></i> <?php echo $sys_pages['account']['name']; ?></a></li>

                                            <?php

                                        } ?>

                                        <li><a href="#" class="sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/logout.php" data-refresh="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['LOG_OUT']; ?></a></li>

                                    </ul>

                                </div>

                            </form>

                            <?php

                        }else{ ?>

                            <a class="popup-modal firstLevel" href="#user-popup">

                                <i class="fas fa-fw fa-power-off"></i>

                            </a>

                            <?php

                        } ?>

                    </li>

                    */ ?>

                    

                    <?php /*

                    <li class="primary btn-nav">

                        <div class="dropdown">

                            <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">

                                <i class="fas fa-fw fa-search"></i> <span class="caret"></span>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                <li>

                                    <?php $csrf_token = get_token("search"); ?>



                                    <form method="post" action="<?php echo DOCBASE.$sys_pages['search']['alias']; ?>" role="form" class="form-inline">

                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                                        <div class="input-group searchWrapper">

                                            <input type="text" class="form-control" name="global-search" placeholder="<?php echo $texts['SEARCH']; ?>">

                                            <span class="input-group-btn">

                                                <button type="submit" class="btn btn-primary" name="send"><i class="fas fa-fw fa-search"></i></button>

                                            </span>

                                        </div>

                                    </form>

                                </li>

                            </ul>

                        </div>

                    </li> */ ?>

                </ul>

                </div> 

                    <?php

                    if(LANG_ENABLED){

                        if(count($langs) > 0){ ?>

                            <div class="primary btn-nav">

                                <div class="dropdown">

                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">

                                        <img src="<?php echo $langs[LANG_TAG]['file']; ?>" alt="<?php echo $langs[LANG_TAG]['title']; ?>"><span class="hidden-sm hidden-md"> <?php echo $langs[LANG_TAG]['title']; ?></span> <span class="caret"></span>

                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        <?php

                                        foreach($langs as $row){

                                            $title_lang = $row['title']; ?>

                                            <li>

                                                <a href="<?php echo DOCBASE.$row['tag']; ?>">

                                                    <img src="<?php echo $row['file']; ?>" alt="<?php echo $title_lang; ?>"> <?php echo $title_lang; ?>

                                                </a>

                                            </li>

                                            <?php

                                        } ?>

                                    </ul>

                                </div>

                            </div>

                            <?php

                        }

                    }

                    if(CURRENCY_ENABLED){

                        if(count($currencies) > 0){ ?>

                            <div class="primary btn-nav">

                                <div class="dropdown">

                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">

                                        <span><?php echo CURRENCY_CODE; ?></span><span class="hidden-sm hidden-md"> <?php echo CURRENCY_SIGN; ?></span> <span class="caret"></span>

                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        <?php

                                        foreach($currencies as $row){ ?>

                                            <li>

                                                <a href="<?php echo getUrl(); ?>" data-action="<?php echo DOCBASE.'includes/change_currency.php'; ?>?curr=<?php echo $row['id']; ?>" class="ajax-link<?php if(!isset($_SESSION['currency']['code'])) echo ' currency-'.$row['code']; ?>">

                                                    <?php echo $row['code'].' '.$row['sign']; ?>

                                                </a>

                                            </li>

                                            <?php

                                        } ?>

                                    </ul>

                                </div>

                            </div>

                            <?php

                        }

                    } ?>





                <div id="user-popup" class="white-popup-block mfp-hide">

                    <div class="fluid-container">

                        <!--<div class="row">

                            <div class="col-xs-12 mb20 text-center">

                                <a class="btn fblogin" href="#"><i class="fas fa-fw fa-facebook"></i> <?php echo $texts['LOG_IN_WITH_FACEBOOK']; ?></a>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 mb20 text-center">

                                - <?php echo $texts['OR']; ?> -

                            </div>

                        </div>-->

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="login-form">

                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">

                                        <div class="alert alert-success" style="display:none;"></div>

                                        <div class="alert alert-danger" style="display:none;"></div>

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-user"></i></div>

                                                <input type="text" class="form-control" name="user" value="" placeholder="<?php echo $texts['USERNAME']." ".strtolower($texts['OR'])." ".$texts['EMAIL']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="user"></div>

                                        </div>

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>

                                                <input type="password" class="form-control" name="pass" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="pass"></div>

                                        </div>

                                        <div class="row mb10">

                                            <div class="col-sm-7 text-left">

                                                <a class="open-pass-form" href="#"><?php echo $texts['FORGOTTEN_PASSWORD']; ?></a><br>

                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>

                                            </div>

                                            <div class="col-sm-5 text-right">

                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate("common/register/login.php"); ?>" data-refresh="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['LOG_IN']; ?></a>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <div class="signup-form">

                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">

                                        <div class="alert alert-success" style="display:none;"></div>

                                        <div class="alert alert-danger" style="display:none;"></div>

                                        <input type="hidden" name="signup_type" value="quick" class="noreset">

                                        <input type="hidden" name="signup_redirect" value="<?php echo getUrl(true).DOCBASE.$sys_pages['account']['alias']; ?>" class="noreset">

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-user"></i></div>

                                                <input type="text" class="form-control" name="username" value="" placeholder="<?php echo $texts['USERNAME']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="username"></div>

                                        </div>

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-envelope"></i></div>

                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="email"></div>

                                        </div>

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>

                                                <input type="password" class="form-control" name="password" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="password"></div>

                                        </div>

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>

                                                <input type="password" class="form-control" name="password_confirm" value="" placeholder="<?php echo $texts['PASSWORD_CONFIRM']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="password_confirm"></div>

                                        </div>

                                        <div class="row mb10">

                                            <div class="col-sm-7 text-left">

                                                <a class="open-login-form" href="#"><?php echo $texts['ALREADY_HAVE_ACCOUNT']; ?></a>

                                            </div>

                                            <div class="col-sm-5 text-right">

                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate("common/register/signup.php"); ?>" data-clear="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['SIGN_UP']; ?></a>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <div class="pass-form">

                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">

                                        <div class="alert alert-success" style="display:none;"></div>

                                        <div class="alert alert-danger" style="display:none;"></div>

                                        <p><?php echo $texts['NEW_PASSWORD_NOTICE']; ?></p>

                                            

                                        <div class="form-group">

                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fas fa-fw fa-envelope"></i></div>

                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">

                                            </div>

                                            <div class="field-notice" rel="email"></div>

                                        </div>

                                        <div class="row mb10">

                                            <div class="col-sm-7 text-left">

                                                <a class="open-login-form" href="#"><?php echo $texts['LOG_IN']; ?></a><br>

                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>

                                            </div>

                                            <div class="col-sm-5 text-right">

                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate("common/register/reset.php"); ?>" data-refresh="false"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['NEW_PASSWORD']; ?></a>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- BOOK NOW BUTTON -->

            <div class="holder-btn-book">

                <div id="fb-widget-1" class="fb-widget" data-fbConfig="0"></div>

                <script class="fb-widget-config" data-fbConfig="0" type="application/json">{"params":[{"calendar":{"firstDayOfWeek":1,"nbMonths2display":2,"title":"BOOK A ROOM","showBestPrice":true,"showLastRoom":true,"showLastRoomThreshold":5,"showChildrenAges":false,"themeDark":false,"layoutNum":1,"roomRateFiltering":0,"rateFilter":[],"roomFilter":[],"useLoyalty":false,"loyalty":"","loyaltyParams":{}},"currency":"EUR","locale":"en_GB","pricesDisplayMode":"normal","maxAdults":4,"maxChildren":1,"mainColor":"#b0a06c","themeDark":false,"openFrontInNewTab":true,"property":"mebud00002","title":"Hotel Vissi d’Arte","childrenMaxAge":12,"quicksearch":{"showChildrenAges":false},"fbWidget":"CalendarInModal"}],"commonParams":{"redirectUrl":"https://redirect.fastbooking.com/DIRECTORY/dispoprice.phtml","showPropertiesList":false,"demoMode":false},"_authCode":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY29wZXMiOiIuKiIsInByb3BlcnRpZXMiOiJtZWJ1ZDAwMDAyIiwiZ3JvdXBzIjoiXiQiLCJmb3IiOiJCYWNrb2ZmaWNlIiwiaWF0IjoxNTgzNDkxMjU2LCJqaWQiOiI1ZTYyMGM5OGYwYzBjIn0.-efeDLoVhjniHz_eCCCbFrDUoolhi_gSmgIJcN4Kbok","propertyIndex":0,"version":"1.40.0-4","baseHost":"websdk.fastbooking-services.com"}</script>

                <link rel="stylesheet" property="stylesheet" href="//websdk.fastbooking-services.com/widgets/app.css">

                <script type="text/javascript" src="//websdk.fastbooking-services.com/widgets/app.js"></script>

                <!-- <a href="https://www.book-secure.com/index.php?s=results&property=mebud00002&arrival=2020-02-25&departure=2020-02-26&adults1=2&children1=0&locale=en_GB&currency=EUR&stid=ydhe85683&redir=BIZ-so5523q0o4&Clusternames=MEBUDHTLHotelVissiDa&rt=1582636026&connectName=MEBUDHTLHotelVissiDa&cname=MEBUDHTLHotelVissiDa&Hotelnames=Me-Hotel-Vissi-DArte&hname=Me-Hotel-Vissi-DArte&cluster=MEBUDHTLHotelVissiDa" target="blank"><button class="btn btn-primary btn-book-now" type="submit" name="book-now">BOOK NOW</button></a> -->

            </div>

            <?php if($appearance['logo_position'] == 3) : ?>

                <a class="navbar-brand" href="<?php echo DOCBASE.trim(LANG_ALIAS, "/"); ?>" title="<?php echo $homepage['title']; ?>"><img src="<?php echo getFromTemplate("images/logo.png"); ?>" alt="<?php echo SITE_TITLE; ?>"></a>

            <?php endif; ?>

            <div class="navbar navbar-default">

                <div class="navbar-header">

                    <div class="ham-menu-btn" id="hamburger-1">

                        <span class="line"></span>

                        <span class="line"></span>

                        <span class="line"></span>

                    </div>

                   

                    <?php if($appearance['logo_position'] == 4) : ?>

                    <a class="navbar-brand" href="<?php echo DOCBASE.trim(LANG_ALIAS, "/"); ?>" title="<?php echo $homepage['title']; ?>"><img src="<?php echo getFromTemplate("images/logo.png"); ?>" alt="<?php echo SITE_TITLE; ?>"></a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</header>

<div class="header--holder"></div>



