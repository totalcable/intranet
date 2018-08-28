<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper" style="margin-top: -60px; "><!--Content wrapper-->

       

        <!-- Build page from here: -->
        <div class="row-fluid">

            <div class="row-fluid">

                        <div class="span12">

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                   
                                        <span> <?php  echo $contents[0]['Level']['name'].' > '.$contents[0]['Subject']['name'].' > '.$contents[0]['Chapter']['name']; ?></span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                  <?php foreach($contents as $content):?>
                                  
                                  <div class="text_desc">
                                    <div class="alert alert-success">
                               
                                <strong><?php echo $content['Study']['topics']; ?></strong> 
                            </div>
                                  
                                  <?php echo $content['Study']['details']; ?>
                                  </div>
                                  
                                    <iframe width="100%" height="400"
                        src="<?php echo $content['Study']['video']; ?>">
                </iframe>
                                 <?php   endforeach;
                                   ?>
                                 
                                </div>

                            </div><!-- End .box -->

                        </div><!-- End .span12 -->

                     

                    </div><!-- End .row-fluid -->

            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->