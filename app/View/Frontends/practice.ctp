<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper" style="margin-top: -60px; "><!--Content wrapper-->
        <!-- Build page from here: -->
        <div class="row-fluid">
<div class="span12">
                    <div class="box">
                     <input type="text" class="hide" id="student_id" value="<?php echo $contents['info']['student_id']; ?>" >
                        <div class="title">
                            <h4> 
                                <span> <?php
                                 $student_name = $contents['info']['student_name'];
                                    echo $contents['info']['level'] . ' > ' . $contents['info']['subject'] . ' > ' . $contents['info']['chapter'];
                                    unset($contents['info']);
                                    ?></span>
                            </h4>

                        </div>
                          </div><!-- End .box -->
                     

                            <?php
                            foreach ($contents as $no => $content):
                                ?>
                                <div class="text_desc hide"  id="pQuestion<?php echo $no + 1; ?>">
                                    <div class="span12">  
                                        <span class="label label-inverse pull-left" style="margin-right:5px;"> প্রশ্ন  <?php echo $no + 1; ?> : </span>
                                        <span><?php echo $content['question']; ?></span>
                                        <label class="label label-inverse pull-left" style="margin-right:5px;"> উত্তরঃ </label> 
                                        <?php echo $content['ans']; ?>
                                        <br/>
                                        <div class="span2"><button class="btn btn-inverse prevBtn" id ="<?php echo $no + 1; ?>">Previous</button></div>
                                        <div class="span3"><button class="btn btn-primary ckeckBtn" id ="<?php echo $no + 1; ?>">Check My Answer</button></div>
                                        <div class="span5 hide notSolveBtn" name="<?php echo $no + 1; ?>" id ="notSolveBtn<?php echo $no + 1; ?>">
                                            <div class="alert alert-error">                              
                                                <strong>Can&#39;t Solve this & Wanna skip this? Then Click</strong>
                                                <button class="btn btn btn-danger notSolveBtn" id ="<?php echo $no + 1; ?>">I can&#39;t Solve this </button>
                                            </div>

                                        </div>
                                        <div class="span1"><button class="btn btn-success nextBtn" id ="<?php echo $no + 1; ?>">Next</button></div>
                                    </div>
                                </div>
                            <?php endforeach;
                            ?>
                        <div class="text_desc hide"  id="pQuestion<?php echo $no + 2; ?>">
                        <div class="alert alert-success">
                                <strong>অভিনন্দন <?php  echo $student_name; ?> তুমি এই অধ্যায়ের সব গুলো সমস্যা অনুশীলন করেছ। তোমার অধ্যাবসায় অব্যহত থাকুক। - আলো আসবেই। </strong> 
                            </div>
                        </div>

                  

                </div><!-- End .span12 -->
                
                
                

        </div><!-- End .row-fluid -->
    </div><!-- End contentwrapper -->
</div><!-- End #content -->