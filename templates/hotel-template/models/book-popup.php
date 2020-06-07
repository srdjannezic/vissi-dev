<div id="bookPopUp" class="hide">
    <div id="bookScroller">
        <div id="bookPopUpHeader">
            <span class="icon-x close-popup"><img src="<?= DOCBASE ?>/templates/hotel-template/images/x.png"></span>
            <h3>Please fill in your data and our representative<br/>will get back to you.</h3>
            
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
        </div>
        <div id="bookPopUpContent">
            <form name="bookPopUp" action="<?php echo DOCBASE ?>send-mail" method="post" class="booking-search">
                <div class="form-group form-drop">
                    <div class="input-group">
                        <select name="gender" class="selectpicker form-control">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <i class="icon-arrow-down"></i>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" name="name" value="" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" name="surname" value="" placeholder="Surname">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" name="phone" value="" placeholder="Telephone">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" name="email" value="" placeholder="E-mail">
                    </div>
                </div>
                <div class="input-wrapper pick-date input-date-wrapper date-left">
                    <span class="icon-calendar"></span>
                    <input type="text" id="from" readonly="true" name="from" placeholder="Start date">
                    <div id="from-datepicker" class="from-datepicker hasDatepicker">
                    </div>
                </div>
                <div class="input-wrapper pick-date input-date-wrapper date-right">
                    <span class="icon-calendar"></span>
                    <input type="text" id="to" readonly="true" name="to" placeholder="End date">
                    <div id="to-datepicker" class="to-datepicker hasDatepicker">
                    </div>
                </div>
                <!-- START DATE -- END DATE -->
                <div class="form-group form-drop">
                    <div class="input-group">
                        <select name="peoples" class="selectpicker form-control">
                            <option>Number of people</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <i class="icon-arrow-down"></i>
                </div>

                <div class="form-group form-drop">
                    <div class="input-group">
                        <select name="reason" class="selectpicker form-control">
                            <option>Reason</option>
                            <option value="lala">lala</option>
                            <option value="lalala">lalala</option>
                            <option value="lalalala">lalalala</option>
                        </select>
                    </div>
                    <i class="icon-arrow-down"></i>
                </div>
                <div class="form-group">
                    <div class="input-wrapper text-message">
                        <textarea name="msg" placeholder="Your remarks / request" rows="4"></textarea>
                    </div>
                    <div class="field-notice" rel="msg"></div>
                </div> 
                <div class="form-group">
                    <div class="input-wrapper">
                        <span class="contact-ask">Do you want to be contacted via</span>
                        <div class="contact-unit">

                            <div class="check-row">
                                <input type="checkbox" class="required css-checkbox" name="contacted" id="checkbox-phone" value=""/>
                                <label class="label-container css-label" for="checkbox-phone"></label>
                                <span class="check-desc">Phone</span>
                            </div>
                            <div class="check-row">
                                <input type="checkbox" class="required css-checkbox" name="contacted" id="checkbox-email" value=""/>
                                <label class="label-container css-label" for="checkbox-email"></label>
                                <span class="check-desc">Email</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group submit-row">       
                    <a href="<?= $book_ref ?>" class="submit-contact btn btn-green"><span>Submit</span></a>
                </div>
            </form>
        </div>
    </div>
</div>