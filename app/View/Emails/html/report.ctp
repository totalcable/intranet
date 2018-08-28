<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <style type="text/css">
            body {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                margin:0 !important;
                width: 100% !important;
                -webkit-text-size-adjust: 100% !important;
                -ms-text-size-adjust: 100% !important;
                -webkit-font-smoothing: antialiased !important;
                background: gray;
            }
            .tableContent img {
                border: 0 !important;
                display: block !important;
                outline: none !important;
            }
            a{
                color:#382F2E;
            }

            p, h1{
                color:#382F2E;
                margin:0;
            }
            p{


                text-align: left;
                color: #322727;
                font-size: 20px;
                font-weight: normal;
                line-height: 30px;
            }

            a.link1{
                color:#382F2E;
            }
            a.link2{
                font-size:16px;
                text-decoration:none;
                color:#ffffff;
            }

            h2{
                text-align:left;
                color:#222222; 
                font-size:19px;
                font-weight:normal;
            }
            div,p,ul,h1{
                margin:0;
            }
            .bodycon {
                font-family: Helvetica,Arial,sans-serif;
                width: 600px;
                table-layout: fixed;text-align: left;
                background: #ffffff;
                border: 1px solid #ffffff;
                border-bottom: 2px solid #bcbcbc;
                border-left: 1px solid #cecece;
                border-right: 1px solid #cecece;
            }
            .contentEditable span {
                font-weight: bold;
            }

            .bgBody{
                background: #ffffff;
            }
            .bgItem{
                background: #DBDBDB;
            }
            .movableContent {
                padding-top: 5%;
            }

        </style>
        <script type="colorScheme" class="swatch active">
            {
            "name":"Default",
            "bgBody":"ffffff",
            "link":"382F2E",
            "color":"999999",
            "bgItem":"ffffff",
            "title":"222222"
            }
        </script>
    </head>
    <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
        <div style="background-color:#dfdfdf;padding:0;margin:0 auto;width:100%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="font-family:Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%!important;font-family:Helvetica,Arial,sans-serif;margin:0;padding:0">
                <tr>
                    <td colspan="5" class="center" style="font: 21px bold !important; color: green !important; text-align: center !important; "> <?php echo $date; ?> </td>
                </tr>
                <tr>
                    
                        <table class="table table-striped" style="color: #000; font-weight: bolder; border: 1px solid black !important;">
                            <tr style="border: 1px solid black !important;">
                                <td style="text-align: center; background:  darkgray !important; "> 
                                    TODAYS INBOUND REPORT
                                </td>  

                                <td style="text-align: center; background: darkgray !important; font-size: 17px;" colspan="4">                                        
                                    TOTAL IN BOUND CALL DCC
                                </td>  
                                <td style="text-align: center; background: lightgrey !important; "> 
                                    <?php echo $total['inbound']; ?>
                                </td>  

                                <td style="text-align: center; background: lightgrey !important; font-size: 17px;" colspan="4">                                        
                                    TOTAL CHECK AND ONLINE PAYMENT
                                </td>  

                                <td style="text-align: center;  background: darkgray !important;"> 
                                    <?php echo $total['check_send'] + $total['online_payment']; ?> 
                                </td>  
                            </tr>

                            <tr style="border: 1px solid black !important;">
                                <td style="text-align: center;" rowspan="2"> 
                                    TOTAL IN BOUND CALL SUPPORT 
                                </td>  

                                <td style="text-align: center;" rowspan="2"> 
                                    <?php echo $total['totalSupport']; ?>

                                </td>  
                                <td style="text-align: center;"> 
                                    SALES ORDER TAKEN
                                </td>  

                                <td style="text-align: center; background: darkgray !important;">                                        
                                    <?php echo $total['done'] ?>
                                </td>  

                                <td style="text-align: center;"> 
                                    SALES QUERY
                                </td>  

                                <td style="text-align: center;">                                        
                                    <?php echo $total['sales_query'] ?>
                                </td>  
                                <td style="text-align: center;"> 
                                    SERVICE / INTERRUPTION RELATED CALL
                                </td>  

                                <td style="text-align: center;">                                        
                                    <?php echo $total['interruption'] ?>
                                </td>

                                <td style="text-align: center;"> 
                                    INBOUND WHOLE SERVICE CANCEL
                                </td>  

                                <td style="text-align: center; background: darkgrey !important;">                                        
                                    <?php echo $total['cancel'] ?>
                                </td>  
                                <td style="text-align: center;"> 
                                    CANCEL FROM HOLD
                                </td>  

                            </tr>   
                            <tr style="border: 1px solid black !important;">
                                <td style="text-align: center;">                                        
                                    RECONNECT
                                </td>  

                                <td style="text-align: center;"> 
                                    <?php echo $total['reconnection']; ?>
                                </td>  

                                <td style="text-align: center;">                                        
                                    VOD
                                </td>  
                                <td style="text-align: center;"> 
                                    <?php echo $total['vod']; ?>
                                </td>  

                                <td style="text-align: center;">                                        
                                    ADDITIONAL SALES RECEIVE
                                </td>

                                <td style="text-align: center;"> 
                                    <?php echo $total['addsalesreceive']; ?> 
                                </td>  

                                <td style="text-align: center;">                                        
                                    CANCEL FROM DEALER & AGENT
                                </td>  
                                <td style="text-align: center;"> 
                                    <?php echo $total['cancel_from_da']; ?>
                                </td>  
                                <td style="text-align: center;"> 
                                    <?php echo $total['cancel_from_hold']; ?>
                                </td> 
                            </tr>   
                            <tr style=" background: silver !important;">
                                <td style="text-align: center;" colspan="11">                                        

                                </td> 
                            </tr>   
                            <tr style="border: 1px solid black !important;">
                                <td style="text-align: center;">                                        
                                    TOTAL IN BOUND CALL ACCOUNTS
                                </td>  

                                <td style="text-align: center;"> 
                                    <?php echo $total['totalAccount']; ?>
                                </td>  

                                <td style="text-align: center;">                                        
                                    CARD INFO TAKEN
                                </td>  
                                <td style="text-align: center;">                                        
                                    <?php echo $total['cardinfotaken']; ?>
                                </td>  
                                <td style="text-align: center;"> 
                                    CHECK SEND
                                </td>  

                                <td style="text-align: center;">                                        
                                    <?php echo $total['check_send'] ?>
                                </td>

                                <td style="text-align: center;"> 
                                    MONEY ORDER ONLINE PAYMENT    
                                </td>  

                                <td style="text-align: center;">                                        
                                    <?php echo $total['online_payment'] ?>
                                </td>  
                                <td style="text-align: center;"> 
                                    SERVICE UNHOLD
                                </td>  
                                <td style="text-align: center;"> 
                                    <?php echo $total['unhold'] ?>
                                </td> 
                                <td style="text-align: center;">
                                    OUT BOUND CALL                                           
                                    <hr style="width: 100%; height: 0px; margin: 0px; padding: 0px;">  
                                        <?php echo $total['totaloutbound'] ?>                                        
                                </td> 
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td height='88'></td></tr>
            </table>
        </div>
    </body>
</html>

