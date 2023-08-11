<?php
$company_phone = "+43 660 1223768";
$company_email = "office@airportdrivervienna24.at";
$website = "airportdrivervienna24.at";

/*echo ride_confirm_customer_en("ime","datum","vreme","adresa","a1","a2","telefon",
    "email","broj ljudi","decja sedista","nacin placanja","koferi","komentar",
    "cena","yes","povratna datum","povratna vreme","povratna adresa","povratna adresa a1",
    "povratna broj ljudi","povratna koferi","povratna decija sedista"
);*/

function ride_confirm_customer_en($name,$date,$time,$full_address,$full_address_a1,$full_address_a2,$phone,$email,$people,$child_seat,$payment,$suitcases,
                                  $comment,$price,$return_ride,$return_date="", $return_time="",$return_address="",$return_address_a1="",$r_people="",
                                  $r_suitcases="",$r_child_seats="",$r_price=""){
    global $company_phone, $company_email, $website;

    if($return_ride=="yes"){
        $return_ride_t = '<p style="margin:0;mso-line-height-alt:30.6px">Date: '.$return_date.'</p>
                          <p style="margin:0;mso-line-height-alt:30.6px">Pickup time: '.$return_time.'</p>
                          <p style="margin:0;mso-line-height-alt:30.6px">Pickup address: '.$return_address.'</p>
                          <p style="margin:0;mso-line-height-alt:30.6px">Additional address: '.$return_address_a1.'</p>
                          <p style="margin:0;mso-line-height-alt:30.6px">People: '.$r_people.'<br>
                                                                         suitcase: '.$r_suitcases.'</p>
                          <p style="margin:0;mso-line-height-alt:30.6px">Child seat: '.$r_child_seats.'</p>
                          <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                            <strong>PRICE (per ride): '.$r_price.'€</strong>&nbsp;(cash)
                          </p>';
    }else{
        $return_ride_t = '';
    }

    return '
    <!DOCTYPE html>
    <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <!--[if mso]>
            <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    <o:AllowPNG/>
                </o:OfficeDocumentSettings>
            </xml><![endif]-->
            <style>
                * {
                    box-sizing: border-box
                }
        
                body {
                    margin: 0;
                    padding: 0
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide, .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0;
                    overflow: hidden
                }
        
                .image_block img + div {
                    display: none
                }
        
                @media (max-width: 620px) {
                    .row-content {
                        width: 100% !important
                    }
        
                    .mobile_hide {
                        display: none
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0
                    }
        
                    .desktop_hide, .desktop_hide table {
                        display: table !important;
                        max-height: none !important
                    }
                }
            </style>
        </head>
        <body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none">
        <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff">
            <tbody>
            <tr>
                <td>
                    <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                        <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:5px;padding-top:5px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                                                <tr>
                                                    <td class="pad" style="padding-bottom:10px;padding-top:10px;width:100%;padding-right:0;padding-left:0">
                                                        <div class="alignment" align="center" style="line-height:10px">
                                                        <img src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/Email%20Templates%20Assets%20Folder/Logos/yourlogohere_icon_black.png_thumb.png" style="display:block;height:auto;border:0;width:48px;max-width:100%" width="48" alt="Alternate text" title="Alternate text"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="divider_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                                                <tr>
                                                    <td class="pad">
                                                        <div class="alignment" align="center">
                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace:0;mso-table-rspace:0">
                                                                <tr>
                                                                    <td class="divider_inner" style="font-size:1px;line-height:1px;border-top:1px solid #dedede">
                                                                        <span>&#8202;</span>
                                                                        </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                        <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:30px;padding-left:20px;padding-right:20px;padding-top:5px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                <tr>
                                                    <td class="pad">
                                                        <div style="font-family:sans-serif">
                                                            <div class style="font-size:12px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;mso-line-height-alt:14.399999999999999px;color:#333;line-height:1.2">
                                                                <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px">
                                                                    <span style="font-size:30px;">Airport taxi Wien, ride Confirmation</span>
                                                                </p>
                                                                </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="text_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                <tr>
                                                    <td class="pad">
                                                        <div style="font-family:sans-serif">
                                                            <div style="font-size:12px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;mso-line-height-alt:21.6px;color:#333;line-height:1.8">
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <span style="font-size:17px;">Dear '.$name.'</span>
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px">&nbsp;</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <span style="font-size:17px;">
                                                                        Thank you and we hereby confirm your order.&nbsp;Below you will find the data you entered.&nbsp;
                                                                        Please check whether the data has been entered correctly.&nbsp;If this is not the case, 
                                                                        please provide the correct data.&nbsp;In that case it is best to contact us by phone.
                                                                        &nbsp;We wish you a pleasant journey.
                                                                    </span>
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px">&nbsp;</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <em><strong>Your ride:</strong></em>
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Date: '.$date.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Pickup time: '.$time.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Pickup address: '.$full_address.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Additional address: '.$full_address_a1.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Second additional address: '.$full_address_a2.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Name: '.$name.'<br>Phone: '.$phone.'<br> Email: '.$email.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Number of people: '.$people.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Number of suitcases: '.$suitcases.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Child seat: '.$child_seat.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Payment: '.$payment.'</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px">&nbsp;</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    Comment: '.$comment.'
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <strong>PRICE (per ride): '.$price.'€</strong>&nbsp;(cash)
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px"> &nbsp;</p>
                                                                
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <em><strong>Return ride:'.$return_ride.'</strong></em></p>
                                                                    '.$return_ride_t.'
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px">&nbsp;</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <strong>Important:</strong><br>The meeting point for transfers from the airport is at "Airport Services"
                                                                </p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    (when you come to the arrivals hall after landing, please
                                                                    turn right).<br>Please switch on your mobile phone
                                                                    immediately after landing, your driver will contact you by
                                                                    phone</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:21.6px">&nbsp;</p>
                                                                <p style="margin:0;text-align:left;mso-line-height-alt:30.6px">
                                                                    <strong>Tel.:&nbsp;'.$company_phone.'96</a></strong><br>
                                                                    <strong>Email: '.$company_email.'<br> Website: '.$website.'.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="button_block block-3" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                                                <tr>
                                                    <td class="pad">
                                                        <div class="alignment" align="center">
                                                            <!--[if mso]>
                                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                                         xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                         style="height:42px;width:168px;v-text-anchor:middle;"
                                                                         arcsize="8%" stroke="false" fillcolor="#000000">
                                                                <w:anchorlock/>
                                                                <v:textbox inset="0px,0px,0px,0px">
                                                                    <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                                                            <![endif]-->
                                                            <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table><!-- End -->
        </body>
    </html>
';
}

function password_reset_template_en($link) {
    return '
        <!DOCTYPE html>
        <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
        <head>
            <title></title>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
            <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
            <!--[if mso]>
            <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    <o:AllowPNG/>
                </o:OfficeDocumentSettings>
            </xml><![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                .image_block img + div {
                    display: none;
                }
        
                .menu_block.desktop_hide .menu-links span {
                    mso-hide: all;
                }
        
                @media (max-width: 700px) {
        
                    .desktop_hide table.icons-inner,
                    .social_block.desktop_hide .social-table {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .fullMobileWidth,
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .menu-checkbox[type=checkbox] ~ .menu-links {
                        display: none !important;
                        padding: 5px 0;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-trigger .menu-open {
                        display: none !important;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-links,
                    .menu-checkbox[type=checkbox] ~ .menu-trigger {
                        display: block !important;
                        max-width: none !important;
                        max-height: none !important;
                        font-size: inherit !important;
                    }
        
                    .menu-checkbox[type=checkbox] ~ .menu-links > a,
                    .menu-checkbox[type=checkbox] ~ .menu-links > span.label {
                        display: block !important;
                        text-align: center;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-trigger .menu-close {
                        display: block !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
        
                #memu-r7c0m2:checked ~ .menu-links {
                    background-color: #000000 !important;
                }
        
                #memu-r7c0m2:checked ~ .menu-links a,
                #memu-r7c0m2:checked ~ .menu-links span {
                    color: #ffffff !important;
                }
            </style>
        </head>
        <body style="background-color: #fff0e3; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
        <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
               style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff0e3;" width="100%">
            <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:30px;line-height:30px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;"> </div>
                                        </td>
                                        <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:10px;line-height:10px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                                       role="presentation"
                                       style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;"
                                       width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="100%">
                                            <table border="0" cellpadding="15" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            </table>
                                            <div class="spacer_block block-2"
                                                 style="height:35px;line-height:35px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-3"
                                                   role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad" style="text-align:center;width:100%;">
                                                        <h1 style="margin: 0; color: #101010; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 27px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Airport taxi Wien</strong></h1>
                                                        <h2 style="margin: 0; color: #101010; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 27px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Forgot Your Password?</strong></h2>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation"
                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                                       role="presentation"
                                       style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;"
                                       width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="16.666666666666668%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;">
                                                 
                                            </div>
                                        </td>
                                        <td class="column column-2"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="66.66666666666667%">
                                            <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1"
                                                   role="presentation"
                                                   style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad"
                                                        style="padding-bottom:10px;padding-left:20px;padding-right:10px;padding-top:10px;">
                                                        <div style="font-family: sans-serif">
                                                            <div class=""
                                                                 style="font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21.6px; color: #848484; line-height: 1.8;">
                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 25.2px;">
                                                                    <span style="font-size:14px;">
                                                                        If you have requested password reset click on link below, othervise ignore this email.
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="spacer_block block-2"
                                                 style="height:10px;line-height:10px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="10" cellspacing="0" class="button_block block-3"
                                                   role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad">
                                                        <div align="center" class="alignment"><!--[if mso]>
                                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                                         xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                         href="www.example.com" style="height:44px;width:160px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#101" fillcolor="#101">
                                                                <w:anchorlock/>
                                                                <v:textbox inset="0px,0px,0px,0px">
                                                                    <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                                                            <![endif]--><a href="'.$link.'" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#101;border-radius:4px;width:auto;border-top:1px solid #101;font-weight:undefined;border-right:1px solid #101;border-bottom:1px solid #101;border-left:1px solid #101;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank">
                                                            <span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;">
                                                                <span style="word-break: break-word; line-height: 32px;">
                                                            Reset Password
                                                                </span>
                                                            </span>
                                                        </a>
                                                            <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="spacer_block block-4" style="height:20px;line-height:20px;font-size:1px;"> 
                                            </div>
                                        </td>
                                        <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;">
                                                 
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:20px;line-height:20px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="0" cellspacing="0" class="social_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                <tr>
                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;text-align:center;">
                                                        <div align="center" class="alignment">
                                                            <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="144px">
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table><!-- End -->
        </body>
        </html>
    ';
}

function new_password_template_en($password) {
    return '
        <!DOCTYPE html>
        <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
        <head>
            <title></title>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
            <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
            <!--[if mso]>
            <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    <o:AllowPNG/>
                </o:OfficeDocumentSettings>
            </xml><![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                .image_block img + div {
                    display: none;
                }
        
                .menu_block.desktop_hide .menu-links span {
                    mso-hide: all;
                }
        
                @media (max-width: 700px) {
        
                    .desktop_hide table.icons-inner,
                    .social_block.desktop_hide .social-table {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .fullMobileWidth,
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .menu-checkbox[type=checkbox] ~ .menu-links {
                        display: none !important;
                        padding: 5px 0;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-trigger .menu-open {
                        display: none !important;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-links,
                    .menu-checkbox[type=checkbox] ~ .menu-trigger {
                        display: block !important;
                        max-width: none !important;
                        max-height: none !important;
                        font-size: inherit !important;
                    }
        
                    .menu-checkbox[type=checkbox] ~ .menu-links > a,
                    .menu-checkbox[type=checkbox] ~ .menu-links > span.label {
                        display: block !important;
                        text-align: center;
                    }
        
                    .menu-checkbox[type=checkbox]:checked ~ .menu-trigger .menu-close {
                        display: block !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
        
                #memu-r7c0m2:checked ~ .menu-links {
                    background-color: #000000 !important;
                }
        
                #memu-r7c0m2:checked ~ .menu-links a,
                #memu-r7c0m2:checked ~ .menu-links span {
                    color: #ffffff !important;
                }
            </style>
        </head>
        <body style="background-color: #fff0e3; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
        <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
               style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff0e3;" width="100%">
            <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:30px;line-height:30px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;"> </div>
                                        </td>
                                        <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:10px;line-height:10px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                                       role="presentation"
                                       style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;"
                                       width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="100%">
                                            <table border="0" cellpadding="15" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            </table>
                                            <div class="spacer_block block-2"
                                                 style="height:35px;line-height:35px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-3"
                                                   role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad" style="text-align:center;width:100%;">
                                                        <h1 style="margin: 0; color: #101010; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 27px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Airport taxi Wien</strong></h1>
                                                        <h2 style="margin: 0; color: #101010; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 27px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>New password</strong></h2>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation"
                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                                       role="presentation"
                                       style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;"
                                       width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="16.666666666666668%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;">
                                                 
                                            </div>
                                        </td>
                                        <td class="column column-2"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="66.66666666666667%">
                                            <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1"
                                                   role="presentation"
                                                   style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad"
                                                        style="padding-bottom:10px;padding-left:20px;padding-right:10px;padding-top:10px;">
                                                        <div style="font-family: sans-serif">
                                                            <div class=""
                                                                 style="font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21.6px; color: #848484; line-height: 1.8;">
                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 25.2px;">
                                                                    <span style="font-size:14px;">
                                                                        Yout new password login is: <b>'.$password.'</b>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="spacer_block block-2"
                                                 style="height:10px;line-height:10px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="10" cellspacing="0" class="button_block block-3"
                                                   role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                   width="100%">
                                                <tr>
                                                    <td class="pad">
                                                        <div align="center" class="alignment"><!--[if mso]>
                                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                                         xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                         href="www.example.com" style="height:44px;width:160px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#101" fillcolor="#101">
                                                                <w:anchorlock/>
                                                                <v:textbox inset="0px,0px,0px,0px">
                                                                    <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                                                            <![endif]-->
                                                        </a>
                                                            <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="spacer_block block-4" style="height:20px;line-height:20px;font-size:1px;"> 
                                            </div>
                                        </td>
                                        <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
                                            <div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;">
                                                 
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                    <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                            <div class="spacer_block block-1" style="height:20px;line-height:20px;font-size:1px;"> 
                                            </div>
                                            <table border="0" cellpadding="0" cellspacing="0" class="social_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                <tr>
                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;text-align:center;">
                                                        <div align="center" class="alignment">
                                                            <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="144px">
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table><!-- End -->
        </body>
        </html>
    ';
}

?>
