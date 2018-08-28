   
<style>

    table, tr, td {
        border: 1px solid black !important;
    }
</style>            

<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>   </li>
        <li>   </li>
        <li>   </li>
    </ul>
    <script></script>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <a id="btnclick" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                Print <i class="fa fa-print"></i>
            </a>

        </div>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="invoice" id="printableArea">
    <div class="row invoice-logo">
        <div class="col-xs-12 invoice-logo-space">
            <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
            <div class="row">
                <div class="col-xs-12" style="text-align: center;">
                    <h3 class="page-title">
                        Report </h3>
                    <small><?php echo $data['date']; ?></small>                            
                </div>
                <div class="col-xs-4">
                </div>                    
            </div>
        </div>
        <div class="col-xs-6">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-6">                    
        </div>
        <div class="col-xs-4">
        </div>
        <div class="col-xs-2 invoice-payment">
            <div style="text-align: left;">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped" style="color: #000; font-weight: bolder; border: 1px solid black !important;">
                <tr style="border: 1px solid black !important;">
                    <td style="text-align: center; background:  darkgray !important; "> 
                        TODAYS INBOUND REPORT
                    </td>  

                    <td style="text-align: center; background: darkgray !important; font-size: 17px;" colspan="4">                                        
                        TOTAL IN BOUND CALL DCC
                    </td>  
                    <td style="text-align: center; background: lightgrey !important; "> 
                        <?php echo $data['total']['inbound']; ?>
                    </td>  

                    <td style="text-align: center; background: lightgrey !important; font-size: 17px;" colspan="4">                                        
                        TOTAL CHECK AND ONLINE PAYMENT
                    </td>  

                    <td style="text-align: center;  background: darkgray !important;"> 
                        <?php echo $data['total']['check_send'] + $data['total']['online_payment'] ?> 
                    </td>  
                </tr>

                <tr style="border: 1px solid black !important;">
                    <td style="text-align: center;" rowspan="2"> 
                        TOTAL IN BOUND CALL SUPPORT 
                    </td>  

                    <td style="text-align: center;" rowspan="2"> 
                        <?php echo $data['total']['totalSupport']; ?>

                    </td>  
                    <td style="text-align: center;"> 
                        SALES ORDER TAKEN
                    </td>  

                    <td style="text-align: center; background: darkgray !important;">                                        
                        <?php echo $data['total']['done'] ?>
                    </td>  

                    <td style="text-align: center;"> 
                        SALES QUERY
                    </td>  

                    <td style="text-align: center;">                                        
                        <?php echo $data['total']['sales_query'] ?>
                    </td>  
                    <td style="text-align: center;"> 
                        SERVICE / INTERRUPTION RELATED CALL
                    </td>  

                    <td style="text-align: center;">                                        
                        <?php echo $data['total']['interruption'] ?>
                    </td>

                    <td style="text-align: center;"> 
                        INBOUND WHOLE SERVICE CANCEL
                    </td>  

                    <td style="text-align: center; background: darkgrey !important;">                                        
                        <?php echo $data['total']['cancel'] ?>
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
                        <?php echo $data['total']['reconnection'] ?>
                    </td>  

                    <td style="text-align: center;">                                        
                        VOD
                    </td>  
                    <td style="text-align: center;"> 
                        <?php echo $data['total']['vod'] ?>
                    </td>  

                    <td style="text-align: center;">                                        
                        ADDITIONAL SALES RECEIVE
                    </td>

                    <td style="text-align: center;"> 
                        <?php echo $data['total']['addsalesreceive'] ?> 
                    </td>  

                    <td style="text-align: center;">                                        
                        CANCEL FROM DEALER & AGENT
                    </td>  
                    <td style="text-align: center;"> 
                        <?php echo $data['total']['cancel_from_da'] ?>
                    </td>  
                    <td style="text-align: center;"> 
                        <?php echo $data['total']['cancel_from_hold'] ?>
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
                        <?php echo $data['total']['totalAccount'] ?>
                    </td>  

                    <td style="text-align: center;">                                        
                        CARD INFO TAKEN
                    </td>  
                    <td style="text-align: center;">                                        
                        <?php echo $data['total']['cardinfotaken'] ?>
                    </td>  
                    <td style="text-align: center;"> 
                        CHECK SEND
                    </td>  

                    <td style="text-align: center;">                                        
                        <?php echo $data['total']['check_send'] ?>
                    </td>

                    <td style="text-align: center;"> 
                        MONEY ORDER ONLINE PAYMENT    
                    </td>  

                    <td style="text-align: center;">                                        
                        <?php echo $data['total']['online_payment'] ?>
                    </td>  
                    <td style="text-align: center;"> 
                        SERVICE UNHOLD
                    </td>  
                    <td style="text-align: center;"> 
                        <?php echo $data['total']['unhold'] ?>
                    </td> 
                    <td style="text-align: center;">
                        OUT BOUND CALL                                           
                        <hr style="width: 100%; height: 0px; margin: 0px; padding: 0px;">  
                        <?php echo $data['total']['totaloutbound'] ?>                                        
                    </td> 
                </tr>
                <tr style="border: 1px solid black !important;">
                    <td style="text-align: center;">                                        
                        TOTAL HOLD
                    </td>
                    <td style="text-align: center;"> 
                        <?php echo $data ['total']['hold'] ?>
                    </td>
                    
                    <td style="text-align: center;"> 
                      Payment Received
                    </td>  
                    <td style="text-align: center;">                                        
                     <?php echo $data ['total']['payment'] ?>
                    </td> 
                    
                    <td style="text-align: center;"> 
                        
                    </td>  
                    <td style="text-align: center;"> 
                    
                    </td> 
                    <td style="text-align: center;">
                                    
                    </td> 
                    <td style="text-align: center;"> 
                    
                    </td> 
                    <td style="text-align: center;">
                                    
                    </td> 
                    <td style="text-align: center;"> 
                    
                    </td> 
                    <td style="text-align: center;">
                                    
                    </td> 
                </tr>
            </table>
        </div>
    </div>
</div>               


