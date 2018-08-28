 <style type="text/css">
     .btn-primary{
         float: right;
     }
     .box .content {
      padding: 0px;
      border-top: 1px solid #c4c4c4;

  }
  span.label.label-warning {
      width: 84px;
  }
</style>
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>UI elements</h3>                    

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                    <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                </form>
                
            </div><!-- End search -->

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" title="back to dashboard">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li>
                <li class="active">UI elements</li>
            </ul>

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->



        <div class="row-fluid"> 
            <div class="span12">
                <div class="page-header">
                    <h4>Images style</h4> 
                      <?php echo $this->Session->flash(); ?>
                                          
                </div>
                <div style="margin-bottom: 27px;">                          

                 <div class="span6">
                    <div class="box">

                        <div class="content" style="display: block;">
                            <div class="row-fluid">
                                <div class="span6">
                                    <a href="#myModal"  data-toggle="modal"> <img src="http://placehold.it/140x140" class="img-polaroid marginR5"></a>

                                </div>
                                <div class="span6">  
                                    <div class="alert alert-success">

                                        <strong>Basic info</strong>
                                    </div>  
                                    <span class="label label-warning">Price</span> &nbsp;<span class="label label-inverse">300 TK</span><br/>
                                    <span class="label label-warning">Discount</span> &nbsp;<span class="label label-inverse">25%</span><br/>
                                    <span class="label label-warning">Service Charge</span> &nbsp;<span class="label label-inverse">30 TK</span><br/>
                                    <span class="label label-warning">Total</span> &nbsp;<span class="label label-inverse">240 TK</span>
                                </div>
                            </div>

                            <div class="title">

                              <span>
                                <button class="btn btn-info" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-info-2 white"></span>Details</button>
                                <button class="btn btn-primary" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-basket white"></span>Buy</button>  
                            </span> 
                        </div>
                    </div><!-- End .box -->
                </div> <!-- End .box -->
            </div><!-- End .span4 -->

            <div class="span6">
                <div class="box">

                    <div class="content" style="display: block;">
                        <div class="row-fluid">
                            <div class="span7">
                                <a href="#myModal"  data-toggle="modal"> <img src="http://placehold.it/140x140" class="img-polaroid marginR5"></a>

                            </div>
                            <div class="span5">  
                                <div class="alert alert-success">

                                    <strong>Basic info</strong>
                                </div>  
                                <span class="label label-warning">Price</span> &nbsp;<span class="label label-inverse">300 TK</span><br/>
                                <span class="label label-warning">Discount</span> &nbsp;<span class="label label-inverse">25%</span><br/>
                                <span class="label label-warning">Service Charge</span> &nbsp;<span class="label label-inverse">30 TK</span><br/>
                                <span class="label label-warning">Total</span> &nbsp;<span class="label label-inverse">240 TK</span>
                            </div>
                        </div>

                        <div class="title">

                          <span>
                            <button class="btn btn-info" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-info-2 white"></span>Details</button>
                            <button class="btn btn-primary" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-basket white"></span>Buy</button>  
                        </span> 
                    </div>
                </div><!-- End .box -->
            </div> <!-- End .box -->
        </div><!-- End .span4 -->


    </div>



</div><!-- End .span12-->
</div> <!-- End .row-fluid-->

<div id="myModal" class="modal hide fade" style="display: none; ">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
      <h3>Order Form</h3>
  </div>
  <div class="modal-body">
    <div class="paddingT15 paddingB15">    
     <div class="row-fluid">

        <div class="span12">

            <div class="box">

                <div class="title">

                    <h4>
                        <span>Fill up the following information and Hit Order button</span>
                    </h4>

                  
                    
                </div>
                <div class="content">
                 <?php echo $this->Form->create('Order', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div'   => false                                  
                                ),
                            'id'=> 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate'=>'novalidate'
                            )
                            ); ?>

                

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Name</label>

                                    <?php echo $this->Form->input(
                                        'name',
                                        array(
                                            'class' => 'span9 text required'

                                            )

                                        ); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3" for="required">Email</label>
                                        <?php echo $this->Form->input(
                                            'email',
                                            array(
                                                'class' => 'span9 text required'
                                                )

                                            ); 
                                            ?>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="mobile">Mobile</label>
                                            <?php

                                            echo $this->Form->input(
                                                'mobile',
                                                array(
                                                   'class' =>'span9 text required',
                                                   'type' => 'password'
                                                   )

                                                ); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="alt_mobile">Alternative Mobile</label>
                                                <?php


                                                echo $this->Form->input(
                                                    'alt_mobile',
                                                    array(

                                                        'class' => 'span9',
                                                        'type' => 'text'
                                                        )

                                                    ); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                            <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">City</label>
                                            <div class="span9 controls sel">
                                                <?php
                                                echo $this->Form->input('city_id', array(
                                                    'type' => 'select',
                                                    'options' => $cities,
                                                    'empty' => '',
                                                    'class' => 'span12 uniform nostyle select1 city required',
                                                    'div' => array('class' => 'span12 required')
                                                    )
                                                );
                                                ?>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>  

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Location</label>
                                            <div class="span9 controls sel">
                                             <?php
                                             echo $this->Form->input('location_id', array(
                                                'type' => 'select',  
                                                'options' => $locations,
                                                'empty' => '',
                                                'class' => 'span12 uniform nostyle location select1 required',
                                                'style' =>'width:100%;',
                                                'div' => array('class' => 'span12 required')
                                                )
                                             );
                                             ?>
                                         </div> 
                                     </div>
                                 </div> 
                             </div>
                        </div>

                    </div><!-- End .box -->

                </div><!-- End .span12 -->

            </div><!-- End .row-fluid -->  
        </div>

    </div>
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal">Close</a>

      <?php 
      echo $this->Form->button(
        'Order', 
        array('class' => 'btn btn-primary', 'type' => 'submit')
        ); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>





</div><!-- End contentwrapper -->
        </div><!-- End #content -->