
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
                            <a title="Click here for add new movie" href="#product-pop-up" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">Add new </a>

                            <!-- pop up for data add start -->
                            <div id="product-pop-up" style="overflow: -webkit-paged-x;display: none; height: 635px; width: 900px;">
                                <div class="product-page product-pop-up">
                                    <div class="row">
                                        <div class="controls center text-center">                                              
                                            <h3>You can add new record here :-)</h3><br><br><br>
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
                                                'url' => array('controller' => 'movietimes', 'action' => 'add_movie')
                                                    )
                                            );
                                            ?>

                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    You have some form errors. Please check below.
                                                </div>
                                                <?php echo $this->Session->flash(); ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-2"> 
                                                            <label>Movie name</label></div>
                                                        <div class="col-md-7">                                                                
                                                            <?php
                                                            echo $this->Form->input('name', array(
                                                                'type' => 'text',
                                                                'class' => 'form-control '
                                                                    )
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-2"> 
                                                            <label>Movie category</label>
                                                        </div>
                                                        <div class="col-md-7" style="inline-box-align:  initial">                                                                
                                                            <?php
                                                            echo $this->Form->input('category', array(
                                                                $options = array('action' => 'Action','adventure' => 'Adventure','comedy' => 'Comedy', 'horror' => 'Horror', 'romantic' => 'Romantic'),
                                                                'type' => 'select',
                                                                'multiple' => 'checkbox',
                                                                'display'=> 'inline',
                                                                'options' => $options)
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-2"> 
                                                            <label>Hero name</label></div>
                                                        <div class="col-md-7">                                                                
                                                            <?php
                                                            echo $this->Form->input('hero', array(
                                                                'type' => 'text',
                                                                'class' => 'form-control '
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
                                                                'class' => 'form-control '
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
                                                                'class' => 'form-control '
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
                                                                'class' => 'form-control '
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
                                                                'class' => 'form-control '
                                                                    )
                                                            );
                                                            ?>
                                                        </div>  
                                                    </div> 
                                                    <br><br><br>
                                                    <div class="row">
                                                        <?php
                                                        echo $this->Form->button(
                                                                'Insert', array('class' => 'btn green', 'type' => 'submit')
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
                            <!-- pop up for data add end -->  
                        </div>
                    </div>
                    <div class="col-xs-4 ">

                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>                                      
                                    <th>
                                        Movie name
                                    </th>

                                    <th>
                                        Category
                                    </th>

                                    <th>
                                        Release year 
                                    </th>

                                    <th>
                                        IMDB rating
                                    </th>

                                    <th>
                                        Cast
                                    </th>

                                    <th>
                                        Duration
                                    </th>

                                    <th>
                                        Last on air
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $data):
                                    $results = $data['movies'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <a target="_blank" title="Click here for view history of this movie :-)" href="<?php echo Router::url(array('controller' => 'movietimes', 'action' => 'movie_history', $results['id'])) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                <?php echo $results['name']; ?></a>
                                        </td>
                                        
                                        <td class="hidden-480">
                                            <?php echo $results['category']; ?>
                                        </td>
                                        
                                        <td class="hidden-480">
                                            <?php echo $results['release_year']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $results['imdb_rating']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <b>Hero: </b> <?php echo $results['hero']; ?><br>
                                            <b>Heroin: </b> <?php echo $results['heroin']; ?>
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $results['duration']; ?> 
                                        </td>
                                        
                                        <td class="hidden-480">
                                            <?php echo $results['on_air_time']; ?> 
                                        </td>
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>                             
    </div>
</div>
<!-- END CONTENT -->

