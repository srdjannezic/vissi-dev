<?php 

require(getFromTemplate('common/send_comment.php', false));



require(getFromTemplate('common/header.php', false)); 





    $msg_error = '';

    $msg_success = '';

    $field_notice = array();

    

   

    if(isset($_POST['msg'])){

        $subject = 'new booking from website';

        // if(CAPTCHA_PKEY != '' && CAPTCHA_SKEY != ''){

        //     require(SYSBASE.'includes/recaptchalib.php');

        

        //     $secret = CAPTCHA_SKEY;

        //     $response = null;

        //     $reCaptcha = new ReCaptcha($secret);

        //     if(isset($_POST['g-recaptcha-response']))

        //         $response = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response']);

        //     if($response == null || !$response->success) $field_notice['captcha'] = $texts['INVALID_CAPTCHA_CODE'];

        // }

        

        $gender = html_entity_decode($_POST['gender'], ENT_QUOTES, 'UTF-8');

        $name = html_entity_decode($_POST['name'], ENT_QUOTES, 'UTF-8');

        $room = html_entity_decode($_POST['room'], ENT_QUOTES, 'UTF-8');

        $surname = html_entity_decode($_POST['surname'], ENT_QUOTES, 'UTF-8');

        $phone = html_entity_decode($_POST['phone'], ENT_QUOTES, 'UTF-8');

        $email = html_entity_decode($_POST['email'], ENT_QUOTES, 'UTF-8');

        $from = html_entity_decode($_POST['from'], ENT_QUOTES, 'UTF-8');

        $to = html_entity_decode($_POST['to'], ENT_QUOTES, 'UTF-8');

        $peoples = html_entity_decode($_POST['peoples'], ENT_QUOTES, 'UTF-8');

        $reason = html_entity_decode($_POST['reason'], ENT_QUOTES, 'UTF-8');

        $msg = html_entity_decode($_POST['msg'], ENT_QUOTES, 'UTF-8');

        $contacted = html_entity_decode($_POST['contacted'], ENT_QUOTES, 'UTF-8');

        $contacted_by = '';
        if(is_array($contacted)){
            foreach ($contacted as $contact) {
                $contacted_by .= $contact . '<br/>';
            }
        }
        //if($name == '') $field_notice['name'] = $texts['REQUIRED_FIELD'];

        //if($msg == '') $field_notice['msg'] = $texts['REQUIRED_FIELD'];

        //if($subject == '') $field_notice['subject'] = $texts['REQUIRED_FIELD'];

        

        // if($email == '' || !preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/i', $email)) $field_notice['email'] = $texts['INVALID_EMAIL'];

        

        if(count($field_notice) == 0){

                

            // $mail = getMail($db, 'CONTACT', array(

            //     '{name}' => $name,

            //     '{phone}' => $phone,

            //     '{email}' => $email,

            //     '{msg}' => nl2br($msg)

            // ));

 

            $content = '<ul>
            <li><b>Name:</b> '.$name. ' ' . $surname . '</li>
            <li><b>Gender:</b> '.$gender.'</li>
            <li><b>Email:</b> '.$email.'</li>
            <li><b>Phone:</b> '.$phone.'</li>
            <li><b>Room Selected:</b> '.$room.'</li>
            <li><b>From:</b> '.$from.'</li>
            <li><b>To:</b> '.$to.'</li>
            <li><b>Number of Peoples:</b> '.$peoples.'</li>
            <li><b>Reason:</b> '.$reason.'</li>
            <li><b>Contact by:</b> '.$contacted_by.'</li>
            <li><b>Message:</b> '.$msg.'</li>
            </ul>';



            //mail to admin

            

            if(sendMail('info@hotelvissidarte.com', 'Vissi d Arte', $subject, $content))

                $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

            else

                $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];


 


            //mail to user

            $usercontent = '<p><b>Thank you for contacting us!</b></p><br/><p>Here are your informations you sent:</p>' . $content;

            if(sendMail($email, $name, 'Thank you for contacting us!', $usercontent))

                $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

            else

                $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];



        }

        else

            $msg_error .= $texts['FORM_ERRORS'];

    }

    elseif(isset($_POST['send'])){ //

        

        $subject = 'You have message from contact form.';



        $name = html_entity_decode($_POST['name'], ENT_QUOTES, 'UTF-8');

        $address = html_entity_decode($_POST['address'], ENT_QUOTES, 'UTF-8');

        $phone = html_entity_decode($_POST['phone'], ENT_QUOTES, 'UTF-8');

        $email = html_entity_decode($_POST['email'], ENT_QUOTES, 'UTF-8');

        $message = html_entity_decode($_POST['message'], ENT_QUOTES, 'UTF-8');



        if(count($field_notice) == 0){

            $content = '<ul>
            <li><b>Name:</b> '.$name. ' ' . $surname . '</li>
            <li><b>Address:</b> '.$address.'</li>
            <li><b>Email:</b> '.$email.'</li>
            <li><b>Phone:</b> '.$phone.'</li>
            <li><b>Message:</b> '.$message.'</li>
            </ul>';

            

            if(sendMail('info@hotelvissidarte.com', "Vissi d Arte", $subject, $content))

                $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

            else

                $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];


            $usercontent = '<p><b>Thank you for contacting us!</b></p><br/><p>Here are your informations you sent:</p>' . $content;

            if(sendMail($email, $name, 'Thank you for contacting us!', $usercontent))

                $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

            else

                $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];

        }

        else

            $msg_error .= $texts['FORM_ERRORS'];

    }

    elseif(isset($_POST['newsletter-submit'])){
        var_dump('test');
        $email = html_entity_decode($_POST['email'], ENT_QUOTES, 'UTF-8');

        $content = 'New subscription from: ' . $email;
        $subject = 'You have new subscription on website.';

        if(sendMail('info@hotelvissidarte.com', "Vissi d Arte", $subject, $content))
            $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

        else
            $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];

        $usercontent = "Thank you for subscribing Vissi d' Arte.";

        if(sendMail($email, $email, 'Thank you for subscribing!', $usercontent))

            $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];

        else

            $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];
    }

    else{

        $msg_success = false;

    }



?>





<main id="page" class="pg-send-mail">



    <?php //include(getFromTemplate('common/page_header.php', false)); ?>



    <div id="content">

        <!--teaser-->    

        <section class="teaser">

            <div class="container">

                <div id="msg-response">

                <?php 

                if($msg_success) : ?>

                    <span class="msg-success"><img src="<?= DOCBASE ?>templates/hotel-template/images/success.svg" /></span>

                    <h3 class="mail-response-title">Thank you!</h3>

                    <p class="mail-response-content">You have successfully summbited your request,<br/>

                        our representive will get shortly in touch.</p>

                <?php else: ?>

                    <span class="msg-error"><img src="<?= DOCBASE ?>templates/hotel-template/images/error.svg" /></span>

                    <h3 class="mail-response-title">Error!</h3>

                    <p class="mail-response-content">You have not completed the form properly.<br/>

                    Please return to the previous page and make sure that<br/>

                    all steps are filled out.</p>

                <?php endif; ?>

                </div>

            </div>

        </section>

    </div>

</div> 