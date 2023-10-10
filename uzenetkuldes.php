<?php
    $MSG = "";
    $visible = "block";
    if($_REQUEST['cim']){
        $to = $_REQUEST['cim'];
    }
    else{
        $to = "info@diatar.eu";
    }
//    ?><!--alert(a cimzett:  --><?php //echo$to?><!--)--><?php
    switch($to)
        {
            case "hoze@diatar.eu":
                        $cimzett = "Hozénak";
                        break;
//            case "jancsi@diatar.eu":
//                       $cimzett = "Jancsinak";
//                        break;
//            default:
						$to = "info@diatar.eu";
                        $cimzett = "a fejlesztőknek!!";
        }
    if((isset($_REQUEST['cmd'])) && ($_REQUEST['cmd'] == "sendmail")) {
        $subject = $_REQUEST['subject'];        
        $_REQUEST['message'] = str_replace("\n","<br />",$_REQUEST['message']);
        $message = "<h5>Webről küldte: " . $_REQUEST['name'] . ":</h5><br />" . $_REQUEST['message'];
        $headers = 'From: "' . $_REQUEST['name'] . '" <' . $_REQUEST['email'] . '>' ."\r\n";
        //$headers .= "Reply-To: <" . $_REQUEST['email'] . ">\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        mail($to,$subject,$message,$headers);

        $MSG = "Üzenet elküldve " . $cimzett;
        $visible = "hidden";
    }
?>
<div class="MAIN_CONTENT_CONTACT" >
    <div class="MAIN_CONTENT_POS1">
        <div class="MESSAGE">
           <?php echo $MSG;?>
        </div>
        <div style="visibility: <?php echo$visible?>;">
            <div class="iconed_title">
                Küldjön üzenetet <?php echo $cimzett ?>:
            </div>
            <div style="margin-left:234px;"  class="red_text expanded">
                Minden mező kitöltése kötelező.
            </div>
            <form action="" method="post" onsubmit="return validateContactForm()">
                <input type="hidden" name="cmd" value="sendmail" />

                <div id="name_label" class="FORM_LABEL"> Az ön neve </div>
                <input type="text" name="name" id="name" class="FORMINPUT_TXT"/>

                <div id="email_label" class="FORM_LABEL"> Az ön E-mail címe </div>
                <input type="text" name="email" id="email" class="FORMINPUT_TXT"/>

                <div id="subject_label" class="FORM_LABEL"> Az üzenet tárgya </div>
                <input type="text" name="subject" id="subject" class="FORMINPUT_TXT"/>

                <div id="message_label" class="FORM_LABEL">  Kérem írja ide az üzenet szövegét:  </div>
                <textarea name="message" id="message" class="FORMINPUT_TXTAREA"></textarea>

                <div class="FORM_BUTTON_CONT">
                    <input type="submit" class="FORM_BUTTON" value="Küldd"/>
                    <input onclick="clearContactForm()" type="button" class="FORM_BUTTON" value="Mindet törlöm"/>
                </div>
            </form>
        </div>
    </div>
</div>