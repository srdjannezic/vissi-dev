<?php debug_backtrace() || die ("Direct access not permitted"); 

$counter = 0;



$widget = getWidgets('footer_col_1',$page_id);

$widget2 = getWidgets('footer_col_3',$page_id);

$footer_col1 = $widget['footer_col_1'][0];

$footer_col3 = $widget2['footer_col_3'][0]; 

//$social = 

?>

<span class="icon-x close-popup hide show-mobile black-x"><img src="<?= DOCBASE ?>templates/hotel-template/images/x.png"></span>

<span class="icon-x close-popup hide show-desktop white-x"><img src="<?= DOCBASE ?>templates/hotel-template/images/x-white.svg"></span>

<!-- book now -->

<section id="search-home-bottom" class="third-section">

    <div class="container">

        <?php 

        $book_id = 1;

        include(getFromTemplate('common/search.php', false));

         ?>

    </div>

</section>

<!-- book mobile btn -->

<div class="book-mob-fix">

    <div id="fb-widget-1" class="fb-widget" data-fbConfig="0"></div>

    <script class="fb-widget-config" data-fbConfig="0" type="application/json">{"params":[{"calendar":{"firstDayOfWeek":1,"nbMonths2display":2,"title":"BOOK A ROOM","showBestPrice":true,"showLastRoom":true,"showLastRoomThreshold":5,"showChildrenAges":false,"themeDark":false,"layoutNum":1,"roomRateFiltering":0,"rateFilter":[],"roomFilter":[],"useLoyalty":false,"loyalty":"","loyaltyParams":{}},"currency":"EUR","locale":"en_GB","pricesDisplayMode":"normal","maxAdults":4,"maxChildren":1,"mainColor":"#b0a06c","themeDark":false,"openFrontInNewTab":true,"property":"mebud00002","title":"Hotel Vissi d’Arte","childrenMaxAge":12,"quicksearch":{"showChildrenAges":false},"fbWidget":"CalendarInModal"}],"commonParams":{"redirectUrl":"https://redirect.fastbooking.com/DIRECTORY/dispoprice.phtml","showPropertiesList":false,"demoMode":false},"_authCode":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzY29wZXMiOiIuKiIsInByb3BlcnRpZXMiOiJtZWJ1ZDAwMDAyIiwiZ3JvdXBzIjoiXiQiLCJmb3IiOiJCYWNrb2ZmaWNlIiwiaWF0IjoxNTgzNDkxMjU2LCJqaWQiOiI1ZTYyMGM5OGYwYzBjIn0.-efeDLoVhjniHz_eCCCbFrDUoolhi_gSmgIJcN4Kbok","propertyIndex":0,"version":"1.40.0-4","baseHost":"websdk.fastbooking-services.com"}</script>

                <link rel="stylesheet" property="stylesheet" href="//websdk.fastbooking-services.com/widgets/app.css">

                <script type="text/javascript" src="//websdk.fastbooking-services.com/widgets/app.js"></script>

</div>

<!-- footer -->

<footer class="footer">

    <div class="footer-main container">

        <div class="footer__info items">

            <div class="logo-wrapper">

                <img src="/templates/hotel-template/images/vissi-darte-logo-grey.svg" alt="logos">

            </div>

            <div class="contact-info">

                <?= $footer_col1['content']; ?>

                <ul class="social-links">

                    <?php getSocialLinks($db); ?>

                </ul>

            </div>

        </div>

        <div class="footer__nav items">

            <ul>

            <?php

            foreach($menus['footer'] as $nav){ 

                $menu_class = get_active_class($nav['id_item'],$page_id);

                ?>

                <li class="<?= $menu_class; ?>">

                    <a href="<?php echo $nav['href']; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>

                </li>

                <?php 

            } ?>

            </ul>

        </div>

        <div class="footer__subscribe items">

            <?= $footer_col3['content']; ?>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="container">

            <div class="footer__copyright">

                <span>All rights reserved Copyright <?= date('Y'); ?></span>

            </div>

        </div>

    </div>

</footer>

</div>

<!-- <a href="#" id="toTop"><i class="fas fa-fw fa-angle-up"></i></a> -->





    <!--[if lt IE 9]>

        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <![endif]-->



    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <!--  <script src="//rawgit.com/tuupola/jquery_lazyload/2.x/lazyload.min.js"></script> -->

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



<!--     <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

   <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script> -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>

  <!--   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script> -->

    <script src=" <?php if(LANG_TAG != "en") : ?>'//rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-<?php echo LANG_TAG; ?>.js',<?php endif; ?>"></script>

    

    <script src="<?php echo DOCBASE; ?>common/js/modernizr-2.6.1.min.js"></script>

    <script src="<?php echo DOCBASE; ?>js/main.js" type="text/javascript"></script>

    <script src="<?php echo DOCBASE; ?>js/custom.js" type="text/javascript"></script>

   <!--  <script src="<?php /*echo DOCBASE;*/ ?>js/plugins/imagefill/js/jquery-imagefill.js"></script> -->

    <!-- <script src="<?php /*echo DOCBASE;*/ ?>js/plugins/toucheeffect/toucheffects.js"></script> -->

    <script src="<?php echo DOCBASE; ?>js/plugins/wow/wow.min.js"></script>

    <script src="<?php echo DOCBASE; ?>js/plugins/slick/slick.min.js"></script>

  <!--   <script src="//use.fontawesome.com/releases/v5.0.3/js/all.js"></script> -->





    <?php

    //CSS required by the current model

    

    if(isset($javascripts)){

        foreach($javascripts as $javascript){ ?>

            <script src="<?php echo $javascript ?>"></script>

            <?php

        }

    } ?>

    <script>

        (function(){

             var ovrl = document.getElementById('overlay');

              //var page = document.getElementById('page-wrapper');

          

            function doneLoading(){



              

              //  setTimeout(function(){ 

              //   page.style.opacity = "1";

              // }, 1000);

              setTimeout(function(){ 

                ovrl.style.display = "none";
                ovrl.style.opacity = 0;
              }, 1500);

             

            }

    

          document.addEventListener('DOMContentLoaded', doneLoading, false);

        }());

    </script>

    <script src='https://www.google.com/recaptcha/api.js'></script>



    <script type="text/javascript">



        //-- Intro slider

        $('.introSlider').slick({

            fade: true,

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: true,

            dots: false,

            autoplay: true,

            speed: 2000,

            pauseOnHover: false,

            responsive: [

                {

                breakpoint: 900,

                    settings: {

                        arrows: false,

                        dots: false

                    }             

                }

            ]

        });



        //-- ROOMS and OFFER slider homepage

         $('.pg-home .s-play').on('init', function() {

            $(this).css("visibility", "visible");

        });

        $('.pg-home .content-slider,.imgSlider__wrapper').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: false,

            dots: true,

            autoplay: true,

            autoplaySpeed: 5000,

            speed: 600,

            pauseOnHover: false,

            responsive: [

                {

                breakpoint: 767,

                    settings: {

                        arrows: true

                    }             

                }

            ]

        });



        /*-- When scroll into view trrigger autoplay--*/ 



        function debounce(func, wait = 200, immediate = true) {

            var timeout;

            return function() {

                var context = this, args = arguments;

                var later = function() {

                timeout = null;

                if (!immediate) func.apply(context, args);

            };

            var callNow = immediate && !timeout;

            clearTimeout(timeout);

            timeout = setTimeout(later, wait);

            if (callNow) func.apply(context, args);

            };

        };

        const $sliderToPlay = document.querySelectorAll('.s-play');



        function checkSlider() {

            $sliderToPlay.forEach(sliderPlay => {

                var slide = $(sliderPlay);

                // bottom of window

                const sliderInAt = (window.scrollY + window.innerHeight);

                const sliderBottom = slide.offset().top + slide.outerHeight() / 2;



                // tops of the slider

                const isHalfShown = slide.offset().top + 300 <= sliderInAt;

                const isNotScrolledPast = window.scrollY < slide.offset().top;

                

                if (isHalfShown && isNotScrolledPast) {

                    console.log('started');

                    

                    slide.slick('play');

                } else {

                   console.log('stoped');

                   

                   slide.slick('pause');

                }

            });

        }



        window.addEventListener('scroll', debounce(checkSlider)); 



        //-- Testimonial slider

        $('.testimonial-slider').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: false,

            dots: true,

            adaptiveHeight: true,

            pauseOnHover: false,

            autoplay: true,

            autoplaySpeed: 4000,

            speed: 600

        });



        //-- Teaser slider



        $('#page .s-play').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: true,

            dots: true,

            pauseOnHover: false,

            autoplay: true,

            autoplaySpeed: 4000,

            speed: 600

        });

        checkSlider();

    </script>



    <script>

         var wow = new WOW(

         {

            mobile: false       // default

            }

        );

        //-- WOW init

        wow.init();

    </script>

    

    <script>

        function prlxEffect() {

            var vissiParallax = document.getElementById('vissi_parallax');

            //var infoParallax = document.getElementsByClassName('infoBlock')

            vissiParallax.style.top = (window.pageYOffset / 3.2) + 'px';

           // infoParallax.style.top = -(window.pageYOffset / 10) + 'px';

        }

        if($(window).width() > 1200 && $('#vissi_parallax').length) {

            window.addEventListener("scroll", prlxEffect);

        }

        

    </script>



	<script type="text/javascript" id="cookiebanner"

        src="https://cdn.jsdelivr.net/gh/dobarkod/cookie-banner@1.2.2/dist/cookiebanner.min.js" data-linkmsg="." data-bg="#c5ae60" data-close-text="ALLOW"></script>



</body>

</html>

