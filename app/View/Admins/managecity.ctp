
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
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Manage City<small> You can add, edit </small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Designation
                        </div>

                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'addcity')) ?>" title="Add new city" class="fa fa-plus">
                            </a>
                            <!--                            <a href="#product-pop-upaa" title="Add new designation"  class="fancybox-fast-view fa fa-plus" style="overflow: -webkit-paged-x;">
                                                        </a>-->


                            <!--                                                        <a tiMovie Name:tle="Click here for individual data update :-)" href="#product-pop-up" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                                                        <b style="color: steelblue;"><?php echo $data_movie_r['name']; ?></b> <br> </a>-->
                            <!-- pop up for data change start -->
                            <div id="product-pop-upaa" style="overflow: -webkit-paged-x;display: none; height: 370px; width: 900px;">
                                <div class="product-page product-pop-up">
                                    <div class="row">
                                        <div class="controls center text-center">                                              
                                            <h3>You can easily modify information here</h3>
                                            <!--<h4 style="color: royalblue;" title="Movie name is : <?php // echo $data_movie_r['name'];   ?> :-)"><?php echo $data_movie_r['name']; ?></h4>-->
                                            <br><br><br>
                                            <!-- BEGIN FORM-->
                                            <?php
                                            echo $this->Form->create('City', array(
                                                'inputDefaults' => array(
                                                    'label' => false,
                                                    'div' => false
                                                ),
                                                'id' => 'form_sample_3',
                                                'class' => 'form-horizontal',
                                                'novalidate' => 'novalidate',
                                                'enctype' => 'multipart/form-data',
                                                'url' => array('controller' => 'admins', 'action' => 'addcity')
                                                    )
                                            );
                                            ?>
                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    You have some form errors. Please check below.
                                                </div>
                                                <?php echo $this->Session->flash(); ?>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">  City Name:<span class="required">
                                                            * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'name', array(
                                                            'class' => 'form-control required',
                                                            'type' => 'text'
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div  style="text-align: right;">
                                                        <?php
                                                        echo $this->Form->button(
                                                                'Add', array('class' => 'btn green', 'type' => 'submit')
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo $this->Form->end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- pop up for data change end --> 
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cities as $single):
                                    $city = $single['City'];
                                    ?>
                                    <tr >
                                        <td><?php echo $city['id']; ?></td>
                                        <td><?php echo $city['name']; ?></td>
                                        <td><?php echo $city['created']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a title="edit" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'editcity', $city['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>                                                                  
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

