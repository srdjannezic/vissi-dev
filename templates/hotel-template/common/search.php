<?php
debug_backtrace() || die ('Direct access not permitted');
//var_dump($book_id);
$max_adults_search = 30;
$max_children_search = 10;

if(!isset($_SESSION['num_adults']))
    $_SESSION['num_adults'] = (isset($_SESSION['book']['adults'])) ? $_SESSION['book']['adults'] : 1;
if(!isset($_SESSION['num_children']))
    $_SESSION['num_children'] = (isset($_SESSION['book']['children'])) ? $_SESSION['book']['children'] : 0;

$from_date = (isset($_SESSION['from_date'])) ? $_SESSION['from_date'] : date('j/m/Y');
$to_date = (isset($_SESSION['to_date'])) ? $_SESSION['to_date'] : date('j/m/Y', time()+86400); ?>

<form action="https://www.book-secure.com/index.php?s=results&property=mebud00002&arrival=&departure=&adults1=&children1=&locale=en_GB&currency=EUR&code=&stid=mdozfae67&arrivalDateValue=&nbdays=2&nbNightsValue=&redir=BIZ-so5523q0o4&Clusternames=MEBUDHTLHotelVissiDa&rt=1582027165&connectName=MEBUDHTLHotelVissiDa&cname=MEBUDHTLHotelVissiDa&Hotelnames=Me-Hotel-Vissi-DArte&hname=Me-Hotel-Vissi-DArte&cluster=MEBUDHTLHotelVissiDa" method="post" class="booking-search" target="_blank">
  <!-- &fromyear=&frommonth=&fromday= -->
    <?php
    if(isset($hotel_id)){ ?>
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
        <?php
    } ?>
    <div class="row">

        <div class="form-group form-date">
            <label class="sr-only" for="from"></label>
            <div class="input-group">
                <div class="input-group-addon"> <?php echo $texts['ARRIVAL_DATE']; ?></div>
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="from_picker<?= $book_id; ?>" name="from_date<?= $book_id; ?>" value="<?php echo $from_date; ?>" autocomplete="off" readonly>
                </div>
                <div id="fromDate-holder<?= $book_id; ?>"></div>
                <i class="icon-calendar"></i>
            </div>
            <div class="field-notice" rel="from_date"></div>
        </div>


        <div class="form-group form-date">
            <div class="input-group">
                <div class="input-group-addon"> <?php echo $texts['DEPARTURE_DATE']; ?></div>
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="to_picker<?= $book_id; ?>" name="to_date<?= $book_id; ?>" value="<?php echo $to_date; ?>" autocomplete="off" readonly>
                </div>
                <div id="toDate-holder<?= $book_id; ?>"></div>
                <i class="icon-calendar"></i>
            </div>
            <div class="field-notice" rel="to_date"></div>
        </div>


        <div class="form-group form-drop">
            <div class="input-group">
                <div class="input-group-addon"><?php echo $texts['PERSONS']; ?></div>
                <select name="num_adults<?= $book_id; ?>" class="selectpicker form-control">
                    <?php
                    for($i = 1; $i <= $max_adults_search; $i++){
                        $select = ($_SESSION['num_adults'] == $i) ? ' selected="selected"' : '';
                        echo '<option value="'.$i.'"'.$select.'>'.$i.'</option>';
                    } ?>
                </select>
            </div>
            <i class="icon-arrow-down"></i>
        </div>


        <div class="form-group form-drop">
            <div class="input-group">
                <div class="input-group-addon"> <?php echo $texts['CHILDREN']; ?></div>
                <select name="num_children<?= $book_id; ?>" class="selectpicker form-control">
                    <?php
                    for($i = 0; $i <= $max_children_search; $i++){
                        $select = ($_SESSION['num_children'] == $i) ? ' selected="selected"' : '';
                        echo '<option value="'.$i.'"'.$select.'>'.$i.'</option>';
                    } ?>
                </select>
            </div>
            <i class="icon-arrow-down"></i>
        </div>

   
        <div class="form-group form-code">
            <label class="sr-only" for="from"></label>
            <div class="input-group">
                 <div class="input-group-addon"> <?php echo $texts['PROMO_CODE']; ?></div>
                <input type="text" name="code" id="code" class="form-control" placeholder="000000">
            </div>
        </div>



        <div class="form-group form-btn">
            <button class="btn btn-block btn-primary" type="submit" name="check_availabilities"><?php echo $texts['BOOK_NOW']; ?></button>
        </div>

        <div class="cancel-reservation">
            <a href="https://www.book-secure.com/index.php?s=cancel&property=mebud00002&locale=en_GB&currency=EUR&stid=31uptp25r&redir=BIZ&connectName=MEBUDHTLHotelVissiDa&cname=MEBUDHTLHotelVissiDa&Hotelnames=Me-Hotel-Vissi-DArte&hname=Me-Hotel-Vissi-DArte&Clusternames=MEBUDHTLHotelVissiDa&cluster=MEBUDHTLHotelVissiDa" target="_blank"><i class="icon-pen"></i>Change / cancel reservation</a>
        </div>

    </div>
</form>
