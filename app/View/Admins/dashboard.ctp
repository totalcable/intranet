<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12"> <h3 style="text-align: center;"> Business Log of CRM</h3>
                <div class="portlet box silver">
                   
<!--                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Add New City
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div><br>-->


                    <!-- END VALIDATION STATES-->
                </div>
                <div class="col-md-3" style=" background-color: silver;"><br>
                    <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Customers</div>
                    <div class="col-md-12" > <br>
                       <b> Last  7 day's Customers: <?php echo $Customer['last7day']; ?> <br>
                           Last 15 day's Customers: <?php echo $Customer['last15day']; ?><br>
                           Last 30 day's Customers: <?php echo $Customer['lastmonth']; ?> <br><br></b>
                    </div>
                </div>

                <div class="col-md-3" style=" background-color: thistle;"><br>
                    <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Total sales</div>
                    <div class="col-md-12" > <br>
                       <b>Last  7 day's Sales: <?php echo $sales['last7day']; ?><br> 
                          Last 15 day's Sales: <?php echo $sales['last15day']; ?><br>
                          Last 30 day's Sales: <?php echo $sales['lastmonth']; ?><br>
                        <br></b>

                    </div>
                </div>

                <div class="col-md-3" style=" background-color: burlywood;"><br>
                    <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Customer Status(Active)</div>
                    <div class="col-md-12" > <br>
                       <b> Active (Last 7 Day's): <?php echo $Service['active7']; ?><br>
                           Active (Last 15 Day's): <?php echo $Service['active15']; ?> <br>
                           Active (Last 30 Day's): <?php echo $Service['active30']; ?> <br><br> </b>
                    </div>                
                </div>

                <div class="col-md-3" style=" background-color:  turquoise;"> <br>                                      
                    <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Customer Status(Hold)</div>
                    <div class="col-md-12" > <br>
                       <b> Hold (Last 7 Day's): <?php echo $Service['hold7']; ?><br>
                           Hold (Last 15 Day's): <?php echo $Service['hold15']; ?> <br>
                           Hold (Last 30 Day's): <?php echo $Service['hold30']; ?> <br><br> </b>
                    </div>
                </div>

                <br> <br> <br>
                <div class="col-md-3" style=" background-color: silver;"><br>
                <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Customer Status(Cancel) </div>
                    <div class="col-md-12" > <br>
                   <b>  Cancel (Last 7 Day's): <?php echo $Service['canceled7']; ?><br>
                        Cancel (Last 15 Day's): <?php echo $Service['canceled15']; ?> <br>
                        Cancel (Last 30 Day's): <?php echo $Service['canceled30']; ?> <br><br> </b>
                    </div>
                </div>
                
                <div class="col-md-3" style=" background-color: thistle;"><br>
                <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;">Open Tickets</div>
                    <div class="col-md-12" > <br>
                    <b>  Open Tickets Last day: <?php echo $Ticket['openlastday']; ?> <br>
                        Open Tickets Last 7 day's: <?php echo $Ticket['openlast7']; ?> <br>
                        Open Tickets Last 15 day's: <?php echo $Ticket['openlast15']; ?><br><br> </b>
                    </div>
                </div>
                
                <div class="col-md-3" style=" background-color: burlywood;"><br>
                <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Solved Tickets </div>
                    <div class="col-md-12" > <br>
                       <b> Solved Tickets Last day: <?php echo $Ticket['solvedlastday']; ?> <br>
                        Solved Tickets Last 7 day's: <?php echo $Ticket['solvedlast7']; ?><br>
                        Solved Tickets Last 15 day's: <?php echo $Ticket['solvedlast15']; ?><br><br> </b>
                    </div>
                </div>
                
                <div class="col-md-3" style=" background-color:  turquoise;"><br>
                <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Recurring </div>
                    <div class="col-md-12" > <br>
                       <span style="font-weight: bold">
                        Total Auto Recurring:<?php echo $total_auto_recurring['total_recurring'];?><br>
                        <br>
                        <br><br>
                    </div>                
                </div>
                
                <br> <br> <br>
                <div class="col-md-3" style=" background-color: silver;"><br>
                <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Payable Amount </div>
                    <div class="col-md-12" > <br>
                        <span style="font-weight: bold">Last 7 day's payable: <?php
                        echo $total_payable_amount['week']; ?><br>
                        Last 15 day's payable: <?php
                        echo $total_payable_amount['half_month'];
                        ?><br>
                        Last 1 month payable: <?php
                        echo $total_payable_amount['full_month'];
                        ?><br><br>
                    </div>
                </div>
                <div class="col-md-3" style=" background-color: thistle;"><br>
                    <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Paid Amount</div>
                    <div class="col-md-12" > <br>
                        <span style="font-weight: bold">
                        Last 7 day's paid: <?php
                        echo $total_paid_amount['week'];
                        ?><br>
                        Last 15 day's paid: <?php
                        echo $total_paid_amount['half_month'];
                        ?><br>
                        Last 1 month paid: <?php
                        echo $total_paid_amount['full_month'];
                        ?><br><br>
                    </div>
                </div>
                <div class="col-md-3" style=" background-color: burlywood;"><br>
                     <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Data 3:</div>
                    <div class="col-md-12" ><br> 
                        A:<br>
                        B:<br>
                        C:<br><br>
                    </div>
                </div>
                <div class="col-md-3" style=" background-color:  turquoise;"><br>
                     <div class="col-md-12" style="text-align: center; color: black; font-weight: bolder;"> Data 4:</div>
                    <div class="col-md-12" > <br>
                        A:<br>
                        B:<br>
                        C:<br><br>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

