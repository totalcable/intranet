
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

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
        <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
            <div class="">                   
                <!-- BEGIN PAGE CONTENT-->
                <br>
                <div class="row">
                    <div class="col-xs-4">                    
                    </div>
                    <div class="col-xs-4">
                        <div style="text-align: center;">
                            <h2>All movies information</h2>
                            <br>

                            <!-- pop up for data change start -->

                            <div class="controls center text-center">                                              
                                <h3>You can easily modify information here</h3>
                                <h4 style="color: royalblue;" title="Movie name is : <?php echo $results['name']; ?> :-)"><?php echo $results['name']; ?></h4>
                                <br><br><br>

                                <?php
                                echo $this->Form->create('Movie', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false,
                                        'id' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'url' => array('controller' => 'movietimes', 'action' => 'update_movie')
                                        )
                                );
                                ?>
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>
                                    <?php echo $this->Session->flash(); ?>
                                    <?php
                                    echo $this->Form->input('id', array(
                                        'type' => 'hidden',
                                        'value' => $results['id']
                                            )
                                    );
                                    ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>Movie name</label></div>
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('name', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['name']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <!--                                                        <div class="row">
                                                                                                    <div class="col-md-2"> 
                                                                                                        <label>Category </label></div>
                                                                                                    <div class="col-md-7">                                                                
                                        <?php
                                        echo $this->Form->input('category ', array(
                                            $options = array('action' => 'Action', 'horror' => 'Horror', 'romantic' => 'Romantic'),
                                            'type' => 'select',
                                            'multiple' => 'checkbox',
                                            'options' => $options)
                                        );
                                        ?>
                                                                                                    </div>
                                                                                                </div>-->
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>Hero name</label></div>
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('hero', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['hero']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>Heroin name</label></div>
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('heroin', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['heroin']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>Release Year</label></div> 
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('release_year', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['release_year']
                                                        )
                                                );
                                                ?>
                                            </div>  
                                        </div>  
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>IMDB Rating</label></div> 
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('imdb_rating', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['imdb_rating']
                                                        )
                                                );
                                                ?>
                                            </div>  
                                        </div>  
                                        <br>
                                        <div class="row">
                                            <div class="col-md-2"> 
                                                <label>Duration</label></div> 
                                            <div class="col-md-7">                                                                
                                                <?php
                                                echo $this->Form->input('duration', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['duration']
                                                        )
                                                );
                                                ?>
                                            </div>  
                                        </div> 
                                        <br><br><br>
                                        <div class="row">
                                            <?php
                                            echo $this->Form->button(
                                                    'Update Information', array('class' => 'btn green', 'type' => 'submit')
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>

                            <!-- pop up for data change end --> 

                        </div>
                    </div>

                </div>


            </div>
        </div>                             
    </div>
</div>
<!-- END CONTENT -->

