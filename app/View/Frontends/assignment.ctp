<script>
document.addEventListener("DOMContentLoaded", function(event) { 
  document.getElementsByTagName("input").disabled=false;
});
</script>

<div id="content" class="clearfix" style="margin-top: 60px; margin-left: 20px;" >
    <div class="contentwrapper"><!--Content wrapper-->
     

         <!--Build page from here: Usual with <div class="row-fluid"></div> -->     
         <?php   
             foreach($questions as $no=>$question):
             ?>
             <div class="row-fluid"> 
             <div class="span12">   
             <span class="label label-inverse pull-left" style="margin-right:5px;"> প্রশ্ন  <?php echo $no+1; ?> : </span>
             <span><?php echo $question['question']; ?></span>
             <label class="label label-inverse pull-left" style="margin-right:5px;"> উত্তরঃ </label> 
              <?php echo $question['ans']; ?>
               
             </div>
             </div>
             <?php endforeach;
          ?>

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
        