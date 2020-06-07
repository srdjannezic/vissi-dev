/* =====================================================================
 * MAIN JS
 * =====================================================================
 */
$(document).ready(function(){
	// $("#from-datepicker").datepicker();
	// $("#to-datepicker").datepicker();

 	$('body').on('click','.close-popup,#book-overlay',function(){
 		$('.popup-box').addClass('hide');
 		$('.icon-x').addClass('hide');
        $('html').removeClass('noScroll');

 		$('body').removeClass('book-popup-active');
 	});


	$( "#from" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	$( "#to" ).datepicker({
		dateFormat: "yy-mm-dd"
	});

	$(document).on('submit','#contact-form, form[name="bookPopUp"]',function(e){
		can_next = true;
		let required = $(this).find('.required');
		required.each(function(i,item){
			console.log(item);
			console.log(jQuery(item).val());
			if(jQuery(item).val() == '' || jQuery(item).val() === null || jQuery(item).val() == false ){
				can_next = false;
				return false;
				console.log('here');
			}
				
		});

		if(can_next){
			$(this).submit();
		}
		else{
			alert('The fields with * are required!');
		}
		e.preventDefault();
	});
  	
	/*-- Mobile menu --*/
	$('.ham-menu-btn').click(function(){
		$('#mainMenu').toggleClass("is-open");
		$(this).toggleClass('is-active');
		
		$('html').toggleClass('noScroll');
	});
    //---------------------------------

    // $(document).on('click','.fb-widget',function(e){
    //     $('html').addClass('noScroll');
    // });
    // $(document).on('click','.fbw-calendar--title',function(e){
    //     $('html').removeClass('noScroll');
    // }); 
    

    $('body').on('click','.book-room-form',function(e){
        $('html').addClass('noScroll');
    	console.log('testtt');
    	$(this).closest('div').find('.popup-box').removeClass('hide');
    	$('.icon-x').removeClass('hide');
    	$('body').addClass('book-popup-active');
    	e.preventDefault();

    	let bookPopUp = $(this).closest('div').find('.popup-box');

        // console.log(bookPopUp.find("#fromDatePopUp-holder"));
        // bookPopUp.find("#fromDatePopUp-holder").datepicker({
        //     startDate: new Date(),
        //     rangeSelect: true,
        //     dateFormat: 'yy-mm-dd',
        //     onSelect: function(date) {
        //         bookPopUp.find("#from-popup").attr('value',date);
        //         bookPopUp.find("#fromDatePopUp-holder").hide();
        //         $(this).closest('form').addClass('selected');
        //     }
        // }).position({
        //     my: "center top",
        //     at: "center bottom",
        //     of: bookPopUp.find("#fromDatePopUp-holder"),
        //     collision: "flipfit"
        // }).hide();
        // bookPopUp.find("#from-popup").focus(function() {
        //     bookPopUp.find("#fromDatePopUp-holder").show();
        // });
    

    
        // bookPopUp.find("#toDatePopUp-holder").datepicker({
        //     startDate: new Date(),
        //     rangeSelect: true,
        //     dateFormat: 'yy-mm-dd',
        //     onSelect: function(date) {
        //         bookPopUp.find("#to-popup").attr('value',date);
        //         bookPopUp.find("#toDatePopUp-holder").hide();
        //         $(this).closest('form').addClass('selected');
        //     }
        // }).position({
        //     my: "center top",
        //     at: "center bottom",
        //     of: bookPopUp.find("#toDatePopUp-holder"),
        //     collision: "flipfit"
        // }).hide();
        // bookPopUp.find("#to-popup").focus(function() {
        //     bookPopUp.find("#toDatePopUp-holder").show();
        // });
        
    });

    $('.view-3d-label').click(function(e){
        $('html').addClass('noScroll');
   		$('#PopUp3d').removeClass('hide');
   		$('.icon-x').removeClass('hide');
    	$('body').addClass('book-popup-active'); 
    	if(screen.width < 900){ 
    		$('.white-x').show();
    		$('.black-x').hide();
    	} 	
    	e.preventDefault();
    });
    // $('.submit-contact').click(function(e){
    // 	$(this).closest('form').submit();
    // 	e.preventDefault();
    // });
/*
https://www.book-secure.com/index.php?s=results&property=mebud00002&arrival=2020-02-18&departure=2020-02-20&adults1=2&children1=0&locale=en_GB&currency=EUR&stid=mdozfae67&arrivalDateValue=2020-02-18&fromyear=2020&frommonth=2&fromday=18&nbdays=2&nbNightsValue=2&redir=BIZ-so5523q0o4&Clusternames=MEBUDHTLHotelVissiDa&rt=1582027165&connectName=MEBUDHTLHotelVissiDa&cname=MEBUDHTLHotelVissiDa&Hotelnames=Me-Hotel-Vissi-DArte&hname=Me-Hotel-Vissi-DArte&cluster=MEBUDHTLHotelVissiDa
*/
	var sbmtcounter = 0;
	var origurl = '';
    $('.booking-search').submit(function(e){
    	let arrival_date = $(this).find('#from_picker').attr('value');
    	let departure_date = $(this).find('#to_picker').attr('value');
    	let adults = $(this).find('select[name="num_adults"] option:selected').attr('value');
    	let childrens = $(this).find('select[name="num_children"] option:selected').attr('value');
    	let code = $(this).find('#code').val();

    	let action_url = $(this).attr('action');
    	
    	if(sbmtcounter == 0) {
    		origurl = action_url;
    	}
    	else{
    		action_url = origurl;
    	}
    	//arrival_date = formatDate(arrival_date);
    	//departure_date = formatDate(departure_date);

    	action_url = action_url.replace("arrival=", "arrival="+arrival_date);
    	//action_url = action_url.replace("arrivalDateValue=", "arrivalDateValue="+arrival_date);

    	action_url = action_url.replace("departure=", "departure="+departure_date);

    	action_url = action_url.replace("adults1=", "adults1="+adults);    	
    	action_url = action_url.replace("children1=", "children1="+childrens);
    	action_url = action_url.replace("code=", "code="+code);

    	console.log(arrival_date);
    	// console.log(departure_date);
    	// console.log(adults);
    	// console.log(childrens);
    	// console.log(code);
    	// console.log(action_url);

    	$(this).attr('action',action_url);

    	//$(this).submit();

    	//e.preventDefault();
    	sbmtcounter++;
    });
    /*-- Book now on mobile fixed bottom  --*/
    if($(window).width() < 768) {

		// Hide Header on on scroll down
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;

		$(window).scroll(function(event){
		    didScroll = true;
		});

		setInterval(function() {
		    if (didScroll) {
		        hasScrolled();
		        didScroll = false;
		    }
		}, 250);

		function hasScrolled() {
		    var st = $(this).scrollTop();
		    
		    // Make sure they scroll more than delta
		    if(Math.abs(lastScrollTop - st) <= delta)
		        return;
		    
		    // If they scrolled down and are past the navbar, add class .nav-up.
		    // This is necessary so you never see what is "behind" the navbar.
		    console.log(screen.width);
		    if(screen.width < 900) {
				    if (st > lastScrollTop){
				        // Scroll Down
				        $('.book-mob-fix').fadeIn();
				    } else {
				        // Scroll Up
				        if(st + $(window).height() < $(document).height()) {
				            $('.book-mob-fix').fadeOut();
				        }
				    }

			}
		    
		    lastScrollTop = st;
		}
	}

	function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();

	    if (month.length < 2) 
	        month = '0' + month;
	    if (day.length < 2) 
	        day = '0' + day;

	    return [year, month, day].join('-');
	}

});
